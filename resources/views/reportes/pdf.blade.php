<!-- filepath: /c:/Users/Usuario/Desktop/Laravel/Project_Git/registro-civil/resources/views/reportes/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte del Registro Civil</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 22px; font-weight: bold; }
        .subtitle { font-size: 16px; margin-top: 5px; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 11px; }
        th { background-color: #f2f2f2; text-align: left; }
        .section-title { font-size: 16px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; }
        .footer { text-align: center; font-size: 10px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">SIAC - Reporte</div>
        <div class="subtitle">Generado el: {{ $fechaGeneracion }}</div>
    </div>

    <div class="info">
        <h3>Filtros aplicados:</h3>
        <p>
            <strong>Período:</strong>
            {{ $filtros['fechaDesde'] ? \Carbon\Carbon::parse($filtros['fechaDesde'])->format('d/m/Y') : 'Sin fecha inicial' }}
            hasta
            {{ $filtros['fechaHasta'] ? \Carbon\Carbon::parse($filtros['fechaHasta'])->format('d/m/Y') : 'Sin fecha final' }}
        </p>
        <p><strong>Ordenado por:</strong>
            @switch($filtros['ordenarPor'])
                @case('fecha_desc')
                    Fecha (más reciente primero)
                    @break
                @case('fecha_asc')
                    Fecha (más antigua primero)
                    @break
                @case('nombre_asc')
                    Nombre (A-Z)
                    @break
                @case('nombre_desc')
                    Nombre (Z-A)
                    @break
            @endswitch
        </p>
    </div>

     <!-- Reportes específicos -->
     @if(isset($datos['nacimientos']) && count($datos['nacimientos']) > 0)
    <div class="section-title nacimientos">Reporte de Nacimientos</div>
    <table>
        <thead>
            <tr>
                <th>Acta ID</th>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Lugar Nacimiento</th>
                @if(isset($filtrosEspecificos['nacidos']['conPadres']) && $filtrosEspecificos['nacidos']['conPadres'])
                <th>Nombre Padre</th>
                <th>Nombre Madre</th>
                @endif
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datos['nacimientos'] as $nacimiento)
                <tr>
                    <td>{{ $nacimiento->acta_id }}</td>
                    <td>{{ $nacimiento->nacido_nombres ?? '' }} {{ $nacimiento->nacido_apellidos ?? '' }}</td>
                    <td>{{ $nacimiento->fecha_nacimiento }}</td>
                    <td>{{ $nacimiento->lugar_nacimiento }}</td>
                    @if(isset($filtrosEspecificos['nacidos']['conPadres']) && $filtrosEspecificos['nacidos']['conPadres'])
                    <td>{{ $nacimiento->padre_nombres ?? $nacimiento->nombre_padre ?? '' }} {{ $nacimiento->padre_apellidos ?? '' }}</td>
                    <td>{{ $nacimiento->madre_nombres ?? $nacimiento->nombre_madre ?? '' }} {{ $nacimiento->madre_apellidos ?? '' }}</td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($nacimiento->fecha_registro)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(isset($datos['nacimientos_por_anio']))
        <div class="section-title nacimientos">Nacimientos por Año</div>
        <table>
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos['nacimientos_por_anio'] as $anio => $grupo)
                    <tr>
                        <td>{{ $anio }}</td>
                        <td>{{ count($grupo) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endif

 @if(isset($datos['matrimonios']) && count($datos['matrimonios']) > 0)
     <div class="section-title matrimonios">Reporte de Matrimonios</div>
     <table>
         <thead>
             <tr>
                 <th>Acta ID</th>
                 <th>Esposo</th>
                 <th>Esposa</th>
                 <th>Fecha Matrimonio</th>
                 <th>Lugar</th>
                 @if($filtrosEspecificos['casados']['conTestigos'])
                 <th>Testigo 1</th>
                 <th>Testigo 2</th>
                 @endif
                 <th>Fecha Registro</th>
             </tr>
         </thead>
         <tbody>
             @foreach($datos['matrimonios'] as $matrimonio)
                 <tr>
                     <td>{{ $matrimonio->acta_id }}</td>
                     <td>{{ $matrimonio->contrayente1_nombre }}</td>
                     <td>{{ $matrimonio->contrayente2_nombre }}</td>
                     <td>{{ $matrimonio->fecha_matrimonio }}</td>
                     <td>{{ $matrimonio->lugar_matrimonio }}</td>
                     @if($filtrosEspecificos['casados']['conTestigos'])
                     <td>{{ $matrimonio->testigo1_nombre }}</td>
                     <td>{{ $matrimonio->testigo2_nombre }}</td>
                     @endif
                     <td>{{ \Carbon\Carbon::parse($matrimonio->fecha_registro)->format('d/m/Y') }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>

     @if(isset($datos['matrimonios_por_anio']))
         <div class="section-title matrimonios">Matrimonios por Año</div>
         <table>
             <thead>
                 <tr>
                     <th>Año</th>
                     <th>Cantidad</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($datos['matrimonios_por_anio'] as $anio => $grupo)
                     <tr>
                         <td>{{ $anio }}</td>
                         <td>{{ count($grupo) }}</td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     @endif
 @endif

 @if(isset($datos['defunciones']) && count($datos['defunciones']) > 0)
     <div class="section-title defunciones">Reporte de Defunciones</div>
     <table>
         <thead>
             <tr>
                 <th>Acta ID</th>
                 <th>Nombre</th>
                 <th>Fecha Defunción</th>
                 <th>Lugar</th>
                 @if($filtrosEspecificos['fallecidos']['conCausa'])
                 <th>Causa de Muerte</th>
                 @endif
                 <th>Fecha Registro</th>
             </tr>
         </thead>
         <tbody>
             @foreach($datos['defunciones'] as $defuncion)
                 <tr>
                     <td>{{ $defuncion->acta_id }}</td>
                     <td>{{ $defuncion->nombres }} {{ $defuncion->apellidos }}</td>
                     <td>{{ $defuncion->fecha_defuncion }}</td>
                     <td>{{ $defuncion->lugar_defuncion }}</td>
                     @if($filtrosEspecificos['fallecidos']['conCausa'])
                     <td>{{ $defuncion->causa_muerte }}</td>
                     @endif
                     <td>{{ \Carbon\Carbon::parse($defuncion->fecha_registro)->format('d/m/Y') }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>

     @if(isset($datos['defunciones_por_anio']))
         <div class="section-title defunciones">Defunciones por Año</div>
         <table>
             <thead>
                 <tr>
                     <th>Año</th>
                     <th>Cantidad</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($datos['defunciones_por_anio'] as $anio => $grupo)
                     <tr>
                         <td>{{ $anio }}</td>
                         <td>{{ count($grupo) }}</td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     @endif
 @endif

 <!-- Incluir los reportes existentes después de los reportes específicos -->
 @if(isset($datos['personas']) && count($datos['personas']) > 0)
     <div class="section-title">Personas</div>
     <!-- Contenido existente... -->
 @endif



    @if(isset($datos['personas']) && count($datos['personas']) > 0)
        <div class="section-title">Usuarios</div>
        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombres</th>
                    <th>Nombre de usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha de creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos['personas'] as $persona)
                    <tr>
                        <td>{{ $persona->persona->dni }}</td>
                        <td>{{ $persona->persona->nombre ?? '-' }} {{ $persona->persona->apellido ?? '-' }}</td>
                        <td>{{ $persona->name ?? '-' }}</td>
                        <td>{{ $persona->email ?? '-' }}</td>
                        <td>{{ method_exists($persona, 'getRoleNames') ? $persona->getRoleNames()->implode(', ') : 'Sin rol' }}</td>
                        <td>{{ $persona->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(isset($datos['actas']) && count($datos['actas']) > 0)
        <div class="section-title">Actas</div>
        <table>
            <thead>
                <tr>
                    <th>L-F-A</th>
                    <th>Tipo</th>
                    <th>Número</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos['actas'] as $acta)
                    <tr>
                        <td>{{ $acta->id }}</td>
                        <td>{{ ucfirst($acta->tipo->descripcion ?? '-') }}</td>
                        <td>{{ $acta->identificador ?? '-' }}</td>
                        <td>{{ $acta->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(isset($datos['libros']) && count($datos['libros']) > 0)
        <div class="section-title">Libros</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos['libros'] as $libro)
                    <tr>
                        <td>{{ $libro->id }}</td>
                        <td>{{ $libro->nombre ?? '-' }}</td>
                        <td>{{ $libro->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(isset($datos['solicitudes']) && count($datos['solicitudes']) > 0)
        <div class="section-title">Solicitudes</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Solicitante</th>
                    <th>Atendiente</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos['solicitudes'] as $solicitud)
                    <tr>
                        <td>{{ $solicitud->id }}</td>
                        <td>{{ $solicitud->acta->tipo->descripcion }}</td>
                        <td>{{ ucfirst($solicitud->estado->descripcion ?? '-') }}</td>
                        <td>{{ $solicitud->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{$solicitud->user->persona->nombre}} {{$solicitud->user->persona->apellido}}</td>
                        <td>{{ ucfirst($solicitud->funcionario->persona->nombre ?? '-')}} {{ ucfirst($solicitud->funcionario->persona->apellido ?? '-')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <p>Total de registros: {{ $datos['total'] }}</p>
        <p>Reporte generado por el sistema integrado de administración civil - SIAC</p>
    </div>
</body>
</html>
