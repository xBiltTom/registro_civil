<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ReporteExport implements WithMultipleSheets
{
    use Exportable;

    protected $datos;
    protected $filtros;
    protected $entidades;
    protected $reportesEspecificos;
    protected $filtrosEspecificos;

    public function __construct($datos, $filtros, $entidades, $reportesEspecificos = [], $filtrosEspecificos = [])
    {
        $this->datos = $datos;
        $this->filtros = $filtros;
        $this->entidades = $entidades;
        $this->reportesEspecificos = $reportesEspecificos;
        $this->filtrosEspecificos = $filtrosEspecificos;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Añadir hoja general con resumen de todos los datos
        $sheets[] = new GeneralSheet($this->datos, $this->filtros, $this->entidades);

        // Añadir hojas para reportes específicos
        if (isset($this->datos['nacimientos']) && count($this->datos['nacimientos']) > 0) {
            $sheets[] = new NacimientosSheet($this->datos['nacimientos'], $this->filtrosEspecificos['nacidos'] ?? []);

            // Añadir hoja de resumen por año si está disponible
            if (isset($this->datos['nacimientos_por_anio'])) {
                $sheets[] = new NacimientosPorAnioSheet($this->datos['nacimientos_por_anio']);
            }
        }

        if (isset($this->datos['matrimonios']) && count($this->datos['matrimonios']) > 0) {
            $sheets[] = new MatrimoniosSheet($this->datos['matrimonios'], $this->filtrosEspecificos['casados'] ?? []);

            if (isset($this->datos['matrimonios_por_anio'])) {
                $sheets[] = new MatrimoniosPorAnioSheet($this->datos['matrimonios_por_anio']);
            }
        }

        if (isset($this->datos['defunciones']) && count($this->datos['defunciones']) > 0) {
            $sheets[] = new DefuncionesSheet($this->datos['defunciones'], $this->filtrosEspecificos['fallecidos'] ?? []);

            if (isset($this->datos['defunciones_por_anio'])) {
                $sheets[] = new DefuncionesPorAnioSheet($this->datos['defunciones_por_anio']);
            }
        }

        // Añadir hojas para entidades estándar
        if (isset($this->datos['personas']) && count($this->datos['personas']) > 0) {
            $sheets[] = new PersonasSheet($this->datos['personas']);
        }

        if (isset($this->datos['actas']) && count($this->datos['actas']) > 0) {
            $sheets[] = new ActasSheet($this->datos['actas']);
        }

        if (isset($this->datos['libros']) && count($this->datos['libros']) > 0) {
            $sheets[] = new LibrosSheet($this->datos['libros']);
        }

        if (isset($this->datos['solicitudes']) && count($this->datos['solicitudes']) > 0) {
            $sheets[] = new SolicitudesSheet($this->datos['solicitudes']);
        }

        return $sheets;
    }
}

// Clase para la hoja general con resumen
class GeneralSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $datos;
    protected $filtros;
    protected $entidades;

    public function __construct($datos, $filtros, $entidades)
    {
        $this->datos = $datos;
        $this->filtros = $filtros;
        $this->entidades = $entidades;
    }

    public function collection()
    {
        $collection = collect();

        // Información de resumen
        $collection->push([
            'Tipo de Reporte', 'Registro Civil - Reporte completo'
        ]);

        $collection->push([
            'Fecha Generación', Carbon::now()->format('d/m/Y H:i:s')
        ]);

        $collection->push([
            'Período',
            ($this->filtros['fechaDesde'] ? Carbon::parse($this->filtros['fechaDesde'])->format('d/m/Y') : 'Sin fecha inicial') .
            ' hasta ' .
            ($this->filtros['fechaHasta'] ? Carbon::parse($this->filtros['fechaHasta'])->format('d/m/Y') : 'Sin fecha final')
        ]);

        $collection->push([
            'Total Registros', $this->datos['total'] ?? 0
        ]);

        // Desglose por tipo
        $collection->push(['', '']);
        $collection->push(['Resumen por Tipo', 'Cantidad']);

        if (isset($this->datos['nacimientos'])) {
            $collection->push(['Nacimientos', count($this->datos['nacimientos'])]);
        }

        if (isset($this->datos['matrimonios'])) {
            $collection->push(['Matrimonios', count($this->datos['matrimonios'])]);
        }

        if (isset($this->datos['defunciones'])) {
            $collection->push(['Defunciones', count($this->datos['defunciones'])]);
        }

        if (isset($this->datos['personas'])) {
            $collection->push(['Usuarios', count($this->datos['personas'])]);
        }

        if (isset($this->datos['actas'])) {
            $collection->push(['Actas', count($this->datos['actas'])]);
        }

        if (isset($this->datos['libros'])) {
            $collection->push(['Libros', count($this->datos['libros'])]);
        }

        if (isset($this->datos['solicitudes'])) {
            $collection->push(['Solicitudes', count($this->datos['solicitudes'])]);
        }

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Información', 'Detalle'
        ];
    }

    public function title(): string
    {
        return 'Resumen';
    }
}

// Clase para la hoja de nacimientos
class NacimientosSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $nacimientos;
    protected $filtros;

    public function __construct($nacimientos, $filtros = [])
    {
        $this->nacimientos = $nacimientos;
        $this->filtros = $filtros;
    }

    public function collection()
    {
        return collect($this->nacimientos)->map(function ($nacimiento) {
            $data = [
                $nacimiento->acta_id,
                $nacimiento->nacido_nombres . ' ' . $nacimiento->nacido_apellidos,
                $nacimiento->fecha_nacimiento,
                $nacimiento->lugar_nacimiento,
                Carbon::parse($nacimiento->fecha_registro)->format('d/m/Y')
            ];

            // Insertar datos de padres si se solicitan
            if (isset($this->filtros['conPadres']) && $this->filtros['conPadres']) {
                // Insertar después del lugar de nacimiento
                array_splice($data, 4, 0, [
                    $nacimiento->padre_nombres . ' ' . $nacimiento->padre_apellidos,
                    $nacimiento->madre_nombres . ' ' . $nacimiento->madre_apellidos
                ]);
            }

            return $data;
        });
    }

    public function headings(): array
    {
        $headings = [
            'Acta ID',
            'Nombre',
            'Fecha Nacimiento',
            'Lugar Nacimiento'
        ];

        if (isset($this->filtros['conPadres']) && $this->filtros['conPadres']) {
            $headings[] = 'Nombre Padre';
            $headings[] = 'Nombre Madre';
        }

        $headings[] = 'Fecha Registro';

        return $headings;
    }

    public function title(): string
    {
        return 'Nacimientos';
    }
}

// Clase para la hoja de nacimientos por año
class NacimientosPorAnioSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $nacimientosPorAnio;

    public function __construct($nacimientosPorAnio)
    {
        $this->nacimientosPorAnio = $nacimientosPorAnio;
    }

    public function collection()
    {
        $collection = collect();

        foreach ($this->nacimientosPorAnio as $anio => $grupo) {
            $collection->push([
                $anio,
                count($grupo)
            ]);
        }

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Año',
            'Cantidad'
        ];
    }

    public function title(): string
    {
        return 'Nacimientos por Año';
    }
}

// Clase para la hoja de matrimonios
class MatrimoniosSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $matrimonios;
    protected $filtros;

    public function __construct($matrimonios, $filtros = [])
    {
        $this->matrimonios = $matrimonios;
        $this->filtros = $filtros;
    }

    public function collection()
    {
        return collect($this->matrimonios)->map(function ($matrimonio) {
            $data = [
                $matrimonio->acta_id,
                $matrimonio->contrayente1_nombre,
                $matrimonio->contrayente2_nombre,
                $matrimonio->fecha_matrimonio,
                $matrimonio->lugar_matrimonio,
                Carbon::parse($matrimonio->fecha_registro)->format('d/m/Y')
            ];

            // Insertar datos de testigos si se solicitan
            if (isset($this->filtros['conTestigos']) && $this->filtros['conTestigos']) {
                // Insertar antes de la fecha de registro
                array_splice($data, 5, 0, [
                    $matrimonio->testigo1_nombre,
                    $matrimonio->testigo2_nombre
                ]);
            }

            return $data;
        });
    }

    public function headings(): array
    {
        $headings = [
            'Acta ID',
            'Esposo',
            'Esposa',
            'Fecha Matrimonio',
            'Lugar'
        ];

        if (isset($this->filtros['conTestigos']) && $this->filtros['conTestigos']) {
            $headings[] = 'Testigo 1';
            $headings[] = 'Testigo 2';
        }

        $headings[] = 'Fecha Registro';

        return $headings;
    }

    public function title(): string
    {
        return 'Matrimonios';
    }
}

// Clase para la hoja de matrimonios por año
class MatrimoniosPorAnioSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $matrimoniosPorAnio;

    public function __construct($matrimoniosPorAnio)
    {
        $this->matrimoniosPorAnio = $matrimoniosPorAnio;
    }

    public function collection()
    {
        $collection = collect();

        foreach ($this->matrimoniosPorAnio as $anio => $grupo) {
            $collection->push([
                $anio,
                count($grupo)
            ]);
        }

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Año',
            'Cantidad'
        ];
    }

    public function title(): string
    {
        return 'Matrimonios por Año';
    }
}

// Clase para la hoja de defunciones
class DefuncionesSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $defunciones;
    protected $filtros;

    public function __construct($defunciones, $filtros = [])
    {
        $this->defunciones = $defunciones;
        $this->filtros = $filtros;
    }

    public function collection()
    {
        return collect($this->defunciones)->map(function ($defuncion) {
            $data = [
                $defuncion->acta_id,
                $defuncion->nombres . ' ' . $defuncion->apellidos,
                $defuncion->fecha_defuncion,
                $defuncion->lugar_defuncion,
                Carbon::parse($defuncion->fecha_registro)->format('d/m/Y')
            ];

            // Insertar causa de muerte si se solicita
            if (isset($this->filtros['conCausa']) && $this->filtros['conCausa']) {
                // Insertar antes de la fecha de registro
                array_splice($data, 4, 0, [
                    $defuncion->causa_muerte
                ]);
            }

            return $data;
        });
    }

    public function headings(): array
    {
        $headings = [
            'Acta ID',
            'Nombre',
            'Fecha Defunción',
            'Lugar'
        ];

        if (isset($this->filtros['conCausa']) && $this->filtros['conCausa']) {
            $headings[] = 'Causa de Muerte';
        }

        $headings[] = 'Fecha Registro';

        return $headings;
    }

    public function title(): string
    {
        return 'Defunciones';
    }
}

// Clase para la hoja de defunciones por año
class DefuncionesPorAnioSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $defuncionesPorAnio;

    public function __construct($defuncionesPorAnio)
    {
        $this->defuncionesPorAnio = $defuncionesPorAnio;
    }

    public function collection()
    {
        $collection = collect();

        foreach ($this->defuncionesPorAnio as $anio => $grupo) {
            $collection->push([
                $anio,
                count($grupo)
            ]);
        }

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Año',
            'Cantidad'
        ];
    }

    public function title(): string
    {
        return 'Defunciones por Año';
    }
}

// Clases para las hojas de entidades estándar
class PersonasSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $personas;

    public function __construct($personas)
    {
        $this->personas = $personas;
    }

    public function collection()
    {
        return collect($this->personas)->map(function ($persona) {
            return [
                $persona->persona->dni ?? '-',
                ($persona->persona->nombre ?? '-') . ' ' . ($persona->persona->apellido ?? '-'),
                $persona->name ?? '-',
                $persona->email ?? '-',
                method_exists($persona, 'getRoleNames') ? $persona->getRoleNames()->implode(', ') : 'Sin rol',
                $persona->created_at->format('d/m/Y H:i:s')
            ];
        });
    }

    public function headings(): array
    {
        return [
            'DNI',
            'Nombres',
            'Nombre de usuario',
            'Email',
            'Rol',
            'Fecha de creación'
        ];
    }

    public function title(): string
    {
        return 'Usuarios';
    }
}

class ActasSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $actas;

    public function __construct($actas)
    {
        $this->actas = $actas;
    }

    public function collection()
    {
        return collect($this->actas)->map(function ($acta) {
            return [
                $acta->id,
                ucfirst($acta->tipo->descripcion ?? '-'),
                $acta->identificador ?? '-',
                $acta->created_at->format('d/m/Y H:i:s')
            ];
        });
    }

    public function headings(): array
    {
        return [
            'L-F-A',
            'Tipo',
            'Número',
            'Fecha'
        ];
    }

    public function title(): string
    {
        return 'Actas';
    }
}

class LibrosSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $libros;

    public function __construct($libros)
    {
        $this->libros = $libros;
    }

    public function collection()
    {
        return collect($this->libros)->map(function ($libro) {
            return [
                $libro->id,
                $libro->nombre ?? '-',
                $libro->created_at->format('d/m/Y H:i:s')
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Fecha de creación'
        ];
    }

    public function title(): string
    {
        return 'Libros';
    }
}

class SolicitudesSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $solicitudes;

    public function __construct($solicitudes)
    {
        $this->solicitudes = $solicitudes;
    }

    public function collection()
    {
        return collect($this->solicitudes)->map(function ($solicitud) {
            return [
                $solicitud->id,
                $solicitud->acta->tipo->descripcion ?? '-',
                ucfirst($solicitud->estado->descripcion ?? '-'),
                $solicitud->created_at->format('d/m/Y H:i:s'),
                ($solicitud->user->persona->nombre ?? '') . ' ' . ($solicitud->user->persona->apellido ?? ''),
                ($solicitud->funcionario->persona->nombre ?? '') . ' ' . ($solicitud->funcionario->persona->apellido ?? '')
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Descripción',
            'Estado',
            'Fecha',
            'Solicitante',
            'Atendiente'
        ];
    }

    public function title(): string
    {
        return 'Solicitudes';
    }
}
