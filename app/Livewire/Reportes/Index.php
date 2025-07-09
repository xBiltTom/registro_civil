<?php

namespace App\Livewire\Reportes;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Acta;
use App\Models\Libro;
use App\Models\Solicitud;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;
use App\Models\ActaDefuncion;
use App\Models\ActaMatrimonio;
use App\Models\ActaNacimiento;

class Index extends Component
{
    public $entidades = [
        'personas' => false,
        'actas' => false,
        'libros' => false,
        'solicitudes' => false,
    ];

    public $reportesEspecificos = [
        'nacidos' => false,
        'casados' => false,
        'fallecidos' => false,
    ];

    public $filtrosEspecificos = [
        'nacidos' => [
            'conPadres' => false,
            'porAnio' => false,
        ],
        'casados' => [
            'conTestigos' => false,
            'porAnio' => false,
        ],
        'fallecidos' => [
            'conCausa' => false,
            'porAnio' => false,
        ],
    ];

    public $filtros = [
        'personas' => [
            'funcionarios' => false,
            'administradores' => false,
            'usuarios' => false,
        ],
        'actas' => [
            'nacimiento' => false,
            'matrimonio' => false,
            'defuncion' => false,
        ],
        'solicitudes' => [
            'pendientes' => false,
            'aprobadas' => false,
            'rechazadas' => false,
        ],
        'fechaDesde' => null,
        'fechaHasta' => null,
        'ordenarPor' => 'fecha_desc',
        'formato' => 'pdf'
    ];

    public function limpiarFiltros()
    {
        $this->entidades = [
            'personas' => false,
            'actas' => false,
            'libros' => false,
            'solicitudes' => false,
        ];

        $this->filtros = [
            'personas' => [
                'funcionarios' => false,
                'administradores' => false,
                'usuarios' => false,
            ],
            'actas' => [
                'nacimiento' => false,
                'matrimonio' => false,
                'defuncion' => false,
            ],
            'solicitudes' => [
                'pendientes' => false,
                'aprobadas' => false,
                'rechazadas' => false,
            ],
            'fechaDesde' => null,
            'fechaHasta' => null,
            'ordenarPor' => 'fecha_desc',
            'formato' => 'pdf'
        ];

        $this->reportesEspecificos = [
            'nacidos' => false,
            'casados' => false,
            'fallecidos' => false,
        ];

        $this->filtrosEspecificos = [
            'nacidos' => [
                'conPadres' => false,
                'porAnio' => false,
            ],
            'casados' => [
                'conTestigos' => false,
                'porAnio' => false,
            ],
            'fallecidos' => [
                'conCausa' => false,
                'porAnio' => false,
            ],
        ];
    }

    public function generarReporte()
    {
        if (!$this->entidades['personas'] && !$this->entidades['actas'] &&
            !$this->entidades['libros'] && !$this->entidades['solicitudes'] &&
            !$this->reportesEspecificos['nacidos'] && !$this->reportesEspecificos['casados'] &&
            !$this->reportesEspecificos['fallecidos']) {
            session()->flash('mensaje', 'Debes seleccionar al menos una entidad para generar el reporte.');
            return;
        }

        $datos = $this->recolectarDatos();

        if (empty($datos) || (isset($datos['total']) && $datos['total'] === 0)) {
            session()->flash('mensaje', 'No se encontraron datos para los filtros seleccionados.');
            return;
        }

        switch ($this->filtros['formato']) {
            case 'pdf':
                return $this->generarPDF($datos);
            case 'excel':
                return $this->generarExcel($datos);
            case 'csv':
                return $this->generarCSV($datos);
            default:
                session()->flash('mensaje', 'Formato de reporte no válido.');
                return;
        }
    }

    private function recolectarDatos()
    {
        $datos = [];
        $fechaDesde = $this->filtros['fechaDesde'] ? Carbon::parse($this->filtros['fechaDesde'])->startOfDay() : null;
        $fechaHasta = $this->filtros['fechaHasta'] ? Carbon::parse($this->filtros['fechaHasta'])->endOfDay() : null;

        // Recolectar datos para reportes específicos
        if ($this->reportesEspecificos['nacidos']) {
            // Consulta base usando eager loading para todas las relaciones necesarias
            $nacimientos = ActaNacimiento::with(['acta', 'nacido', 'padre', 'madre', 'lugar']);

            // Filtro por padres completos si está seleccionado
            if ($this->filtrosEspecificos['nacidos']['conPadres']) {
                $nacimientos->whereHas('padre')->whereHas('madre');
            }

            // Filtro por rango de fechas
            if ($fechaDesde || $fechaHasta) {
                $nacimientos->whereHas('acta', function($query) use ($fechaDesde, $fechaHasta) {
                    if ($fechaDesde) {
                        $query->where('created_at', '>=', $fechaDesde);
                    }
                    if ($fechaHasta) {
                        $query->where('created_at', '<=', $fechaHasta);
                    }
                });
            }

            // Ordenamiento usando relaciones Eloquent
            switch ($this->filtros['ordenarPor']) {
                case 'fecha_desc':
                    $nacimientos->whereHas('acta', function($query) {
                        $query->orderBy('created_at', 'desc');
                    });
                    break;
                case 'fecha_asc':
                    $nacimientos->whereHas('acta', function($query) {
                        $query->orderBy('created_at', 'asc');
                    });
                    break;
                case 'nombre_asc':
                    $nacimientos->whereHas('nacido', function($query) {
                        $query->orderBy('nombres', 'asc');
                    });
                    break;
                case 'nombre_desc':
                    $nacimientos->whereHas('nacido', function($query) {
                        $query->orderBy('nombres', 'desc');
                    });
                    break;
            }

            // Obtener y transformar los resultados
            $nacimientosData = $nacimientos->get();
            $datos['nacimientos'] = $nacimientosData->map(function($nacimiento) {
                return (object)[
                    'acta_id' => $nacimiento->acta->id,
                    'fecha_registro' => $nacimiento->acta->created_at,
                    'fecha_nacimiento' => $nacimiento->fecha_nacimiento,
                    'lugar_nacimiento' => $nacimiento->lugar ? $nacimiento->lugar->distrito : null,
                    'nacido_nombres' => $nacimiento->nacido ? $nacimiento->nacido->nombre : null,
                    'nacido_apellidos' => $nacimiento->nacido ? $nacimiento->nacido->apellido : null,
                    'padre_nombres' => $nacimiento->padre ? $nacimiento->padre->nombre : null,
                    'padre_apellidos' => $nacimiento->padre ? $nacimiento->padre->apellido : null,
                    'madre_nombres' => $nacimiento->madre ? $nacimiento->madre->nombre : null,
                    'madre_apellidos' => $nacimiento->madre ? $nacimiento->madre->apellido : null,
                ];
            });

            // Agrupar por año si se seleccionó esa opción
            if ($this->filtrosEspecificos['nacidos']['porAnio']) {
                $datos['nacimientos_por_anio'] = $datos['nacimientos']->groupBy(function($item) {
                    return Carbon::parse($item->fecha_registro)->format('Y');
                });
            }
        }

        if ($this->reportesEspecificos['casados']) {
            // Consulta base usando eager loading para todas las relaciones necesarias
            $matrimonios = ActaMatrimonio::with(['acta', 'novio', 'novia', 'testigo1', 'testigo2']);

            // Filtro por testigos completos si está seleccionado
            if ($this->filtrosEspecificos['casados']['conTestigos']) {
                $matrimonios->whereHas('testigo1')
                            ->whereHas('testigo2');
            }

            // Filtro por rango de fechas
            if ($fechaDesde || $fechaHasta) {
                $matrimonios->whereHas('acta', function($query) use ($fechaDesde, $fechaHasta) {
                    if ($fechaDesde) {
                        $query->where('created_at', '>=', $fechaDesde);
                    }
                    if ($fechaHasta) {
                        $query->where('created_at', '<=', $fechaHasta);
                    }
                });
            }

            // Ordenamiento usando relaciones Eloquent
            switch ($this->filtros['ordenarPor']) {
                case 'fecha_desc':
                    $matrimonios->whereHas('acta', function($query) {
                        $query->orderBy('created_at', 'desc');
                    });
                    break;
                case 'fecha_asc':
                    $matrimonios->whereHas('acta', function($query) {
                        $query->orderBy('created_at', 'asc');
                    });
                    break;
                case 'nombre_asc':
                    $matrimonios->whereHas('novio', function($query) {
                        $query->orderBy('nombres', 'asc');
                    });
                    break;
                case 'nombre_desc':
                    $matrimonios->whereHas('novio', function($query) {
                        $query->orderBy('nombres', 'desc');
                    });
                    break;
            }

            // Obtener y transformar los resultados
            $matrimoniosData = $matrimonios->get();
            $datos['matrimonios'] = $matrimoniosData->map(function($matrimonio) {
                return (object)[
                    'acta_id' => $matrimonio->acta->id,
                    'fecha_registro' => $matrimonio->acta->created_at,
                    'fecha_matrimonio' => $matrimonio->fecha_matrimonio,
                    'lugar_matrimonio' => $matrimonio->lugar_matrimonio ?? 'Chicama',
                    'contrayente1_nombre' => $matrimonio->novio ? $matrimonio->novio->nombre . ' ' . $matrimonio->novio->apellido : null,
                    'contrayente2_nombre' => $matrimonio->novia ? $matrimonio->novia->nombre . ' ' . $matrimonio->novia->apellido : null,
                    'testigo1_nombre' => $matrimonio->testigo1 ? $matrimonio->testigo1->nombre . ' ' . $matrimonio->testigo1->apellido : null,
                    'testigo2_nombre' => $matrimonio->testigo2 ? $matrimonio->testigo2->nombre . ' ' . $matrimonio->testigo2->apellido : null,
                ];
            });

            // Agrupar por año si se seleccionó esa opción
            if ($this->filtrosEspecificos['casados']['porAnio']) {
                $datos['matrimonios_por_anio'] = $datos['matrimonios']->groupBy(function($item) {
                    return Carbon::parse($item->fecha_registro)->format('Y');
                });
            }
        }

        if ($this->reportesEspecificos['fallecidos']) {
            // Consulta base usando eager loading para todas las relaciones necesarias
            $defunciones = ActaDefuncion::with(['acta', 'fallecido', 'declarante']);

            // Filtro por causa de muerte si está seleccionado
            if ($this->filtrosEspecificos['fallecidos']['conCausa']) {
                $defunciones->whereNotNull('detalle');
            }

            // Filtro por rango de fechas
            if ($fechaDesde || $fechaHasta) {
                $defunciones->whereHas('acta', function($query) use ($fechaDesde, $fechaHasta) {
                    if ($fechaDesde) {
                        $query->where('created_at', '>=', $fechaDesde);
                    }
                    if ($fechaHasta) {
                        $query->where('created_at', '<=', $fechaHasta);
                    }
                });
            }

            // Ordenamiento usando relaciones Eloquent
            switch ($this->filtros['ordenarPor']) {
                case 'fecha_desc':
                    $defunciones->whereHas('acta', function($query) {
                        $query->orderBy('created_at', 'desc');
                    });
                    break;
                case 'fecha_asc':
                    $defunciones->whereHas('acta', function($query) {
                        $query->orderBy('created_at', 'asc');
                    });
                    break;
                case 'nombre_asc':
                    $defunciones->whereHas('fallecido', function($query) {
                        $query->orderBy('nombres', 'asc');
                    });
                    break;
                case 'nombre_desc':
                    $defunciones->whereHas('fallecido', function($query) {
                        $query->orderBy('nombres', 'desc');
                    });
                    break;
            }

            // Obtener y transformar los resultados
            $defuncionesData = $defunciones->get();
            $datos['defunciones'] = $defuncionesData->map(function($defuncion) {
                return (object)[
                    'acta_id' => $defuncion->acta->id,
                    'fecha_registro' => $defuncion->acta->created_at,
                    'fecha_defuncion' => $defuncion->fecha_defuncion,
                    'lugar_defuncion' => $defuncion->lugar_defuncion ?? 'Chicama',
                    'causa_muerte' => $defuncion->detalle,
                    'nombres' => $defuncion->fallecido ? $defuncion->fallecido->nombre : null,
                    'apellidos' => $defuncion->fallecido ? $defuncion->fallecido->apellido : null,
                    'declarante_nombre' => $defuncion->declarante ? $defuncion->declarante->nombre . ' ' . $defuncion->declarante->apellido : null,
                ];
            });

            // Agrupar por año si se seleccionó esa opción
            if ($this->filtrosEspecificos['fallecidos']['porAnio']) {
                $datos['defunciones_por_anio'] = $datos['defunciones']->groupBy(function($item) {
                    return Carbon::parse($item->fecha_registro)->format('Y');
                });
            }
        }

        if ($this->entidades['personas']) {
            $personas = User::query();

            if ($this->filtros['personas']['funcionarios'] ||
                $this->filtros['personas']['administradores'] ||
                $this->filtros['personas']['usuarios']) {

                $tieneRolesEspecificos = $this->filtros['personas']['funcionarios'] ||
                                        $this->filtros['personas']['administradores'];
                $incluyeUsuariosNormales = $this->filtros['personas']['usuarios'];

                if ($tieneRolesEspecificos && $incluyeUsuariosNormales) {
                    $roles = [];
                    if ($this->filtros['personas']['funcionarios']) $roles[] = 'funcionario';
                    if ($this->filtros['personas']['administradores']) $roles[] = 'admin';

                    $personas->where(function($query) use ($roles) {
                        $query->whereHas('roles', function($q) use ($roles) {
                            $q->whereIn('name', $roles);
                        })
                        ->orWhereDoesntHave('roles');
                    });
                }
                elseif ($tieneRolesEspecificos) {
                    $roles = [];
                    if ($this->filtros['personas']['funcionarios']) $roles[] = 'funcionario';
                    if ($this->filtros['personas']['administradores']) $roles[] = 'admin';

                    $personas->whereHas('roles', function($query) use ($roles) {
                        $query->whereIn('name', $roles);
                    });
                }
                elseif ($incluyeUsuariosNormales) {
                    $personas->whereDoesntHave('roles');
                }
            }

            if ($fechaDesde) {
                $personas->where('created_at', '>=', $fechaDesde);
            }
            if ($fechaHasta) {
                $personas->where('created_at', '<=', $fechaHasta);
            }
            $this->aplicarOrdenamiento($personas);

            $datos['personas'] = $personas->get();
        }

    if ($this->entidades['actas']) {
        $tiposActasIds = [];
        if ($this->filtros['actas']['nacimiento']) $tiposActasIds[] = 1;
        if ($this->filtros['actas']['matrimonio']) $tiposActasIds[] = 2;
        if ($this->filtros['actas']['defuncion']) $tiposActasIds[] = 3;

        $actas = Acta::query();

        if (!empty($tiposActasIds)) {
            $actas->whereIn('tipo_id', $tiposActasIds);
        }

        if ($fechaDesde) {
            $actas->where('created_at', '>=', $fechaDesde);
        }
        if ($fechaHasta) {
            $actas->where('created_at', '<=', $fechaHasta);
        }

        $this->aplicarOrdenamiento($actas);

        $actas->with('tipo');

        $datos['actas'] = $actas->get();
    }

        if ($this->entidades['libros']) {
            $libros = Libro::query();

            if ($fechaDesde) {
                $libros->where('created_at', '>=', $fechaDesde);
            }
            if ($fechaHasta) {
                $libros->where('created_at', '<=', $fechaHasta);
            }

            $this->aplicarOrdenamiento($libros);

            $datos['libros'] = $libros->get();
        }

        if ($this->entidades['solicitudes']) {
            $estados = [];
            if ($this->filtros['solicitudes']['pendientes']) $estados[] = 'pendiente';
            if ($this->filtros['solicitudes']['aprobadas']) $estados[] = 'aprobada';
            if ($this->filtros['solicitudes']['rechazadas']) $estados[] = 'rechazada';

            $solicitudes = Solicitud::query();

            if (!empty($estados)) {
                $solicitudes->whereIn('estado', $estados);
            }

            if ($fechaDesde) {
                $solicitudes->where('created_at', '>=', $fechaDesde);
            }
            if ($fechaHasta) {
                $solicitudes->where('created_at', '<=', $fechaHasta);
            }

            $this->aplicarOrdenamiento($solicitudes);

            $datos['solicitudes'] = $solicitudes->get();
        }


        $total = 0;
        foreach ($datos as $entidad => $registros) {
            if ($entidad !== 'total') {
                $total += count($registros);
            }
        }
        $datos['total'] = $total;

        return $datos;
    }

    private function aplicarOrdenamiento($query)
    {
        switch ($this->filtros['ordenarPor']) {
            case 'fecha_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'fecha_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'nombre_asc':
                if (method_exists($query->getModel(), 'getTable')) {
                    $table = $query->getModel()->getTable();
                    if (in_array('name', $query->getModel()->getFillable())) {
                        $query->orderBy('name', 'asc');
                    } elseif (in_array('nombre', $query->getModel()->getFillable())) {
                        $query->orderBy('nombre', 'asc');
                    } else {
                        $query->orderBy('id', 'asc');
                    }
                }
                break;
            case 'nombre_desc':
                if (method_exists($query->getModel(), 'getTable')) {
                    $table = $query->getModel()->getTable();
                    if (in_array('name', $query->getModel()->getFillable())) {
                        $query->orderBy('name', 'desc');
                    } elseif (in_array('nombre', $query->getModel()->getFillable())) {
                        $query->orderBy('nombre', 'desc');
                    } else {
                        $query->orderBy('id', 'desc');
                    }
                }
                break;
        }
    }

    private function generarPDF($datos)
    {
        $fileName = 'reporte_' . date('Y-m-d_H-i-s') . '.pdf';

        $pdf = PDF::loadView('reportes.pdf', [
            'datos' => $datos,
            'filtros' => $this->filtros,
            'entidades' => $this->entidades,
            'filtrosEspecificos' => $this->filtrosEspecificos,
            'fechaGeneracion' => Carbon::now()->format('d/m/Y H:i:s')
        ]);

        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, $fileName);
    }

    private function generarExcel($datos){
        $fileName = 'reporte_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(
            new ReporteExport(
                $datos,
                $this->filtros,
                $this->entidades,
                $this->reportesEspecificos,
                $this->filtrosEspecificos
            ),
            $fileName
        );
    }

    private function generarCSV($datos)
    {
        $fileName = 'reporte_' . date('Y-m-d_H-i-s') . '.csv';

        return Excel::download(
            new ReporteExport(
                $datos,
                $this->filtros,
                $this->entidades,
                $this->reportesEspecificos,
                $this->filtrosEspecificos
            ),
            $fileName,
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    public function render()
    {
        return view('livewire.reportes.index');
    }
}
