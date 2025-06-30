<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Acta de Nacimiento</title>
  <style>
    @page {
      margin: 2cm;
    }

    body {
      font-family: 'DejaVu Sans', Arial, sans-serif;
      font-size: 12px;
      line-height: 1.4;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      padding: 0;
    }

    h1, h2 {
      text-align: center;
      margin: 0;
      padding: 4px 0;
    }

    h1 {
      font-size: 18px;
      margin-bottom: 5px;
    }

    h2 {
      font-size: 12px;
      font-weight: normal;
      color: #555;
      margin-bottom: 10px;
    }

    .section {
      margin-bottom: 10px;
    }

    .section-title {
      font-size: 13px;
      font-weight: bold;
      margin-bottom: 5px;
      border-bottom: 1px solid #999;
      padding-bottom: 2px;
    }

    .details {
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 8px;
      background-color: #fdfdfd;
    }

    .details p {
      margin: 3px 0;
    }

    .label {
      font-weight: bold;
    }

    .footer {
      text-align: center;
      font-size: 11px;
      color: #666;
      margin-top: 20px;
      border-top: 1px solid #ccc;
      padding-top: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Acta de Nacimiento</h1>
    <h2>Fecha de impresión: {{$fecha_actual}}</h2>

    <div class="section">
      <div class="section-title">Detalles del Acta</div>
      <div class="details">
        <p><span class="label">Fecha del acta:</span> {{$acta->fecha_registro}}</p>
        <p><span class="label">Libro:</span> {{$acta->folio->libro_id}}</p>
        <p><span class="label">Folio:</span> {{$acta->folio_id}}</p>
        <p><span class="label">Acta:</span> {{$acta->id}}</p>
      </div>
    </div>

    <div class="section">
        <div class="section-title">Información del Nacido</div>
        <div class="details">
            <p><span class="label">Nombres y Apellidos:</span> {{$acta->actaNacimiento->nacido->nombre ?? 'N/A'}} {{$acta->actaNacimiento->nacido->apellido ?? 'N/A'}}</p>
            <p><span class="label">Fecha de nacimiento:</span> {{$acta->actaNacimiento->nacido->fecha_nacimiento ?? 'N/A'}}</p>
            <p><span class="label">Sexo:</span> {{$acta->actaNacimiento->nacido->sexo == 'M' ? 'Masculino' : 'Femenino'}}</p>
            <p><span class="label">Lugar de nacimiento:</span>
                {{$acta->actaNacimiento->nacido->lugar->distrito ?? 'N/A'}},
                {{$acta->actaNacimiento->nacido->lugar->provincia ?? 'N/A'}},
                {{$acta->actaNacimiento->nacido->lugar->departamento ?? 'N/A'}}
            </p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Información de los Padres</div>
        <div class="details">
          <p><span class="label">Nombre de la Madre:</span> {{$madre->nombre}} {{$madre->apellido}}</p>
          <p><span class="label">DNI de la Madre:</span> {{$madre->dni}}</p>
          <p><span class="label">Nombre del Padre:</span> {{$padre->nombre}} {{$padre->apellido}}</p>
          <p><span class="label">DNI del Padre:</span> {{$padre->dni}}</p>
        </div>
    </div>

    <div class="footer">
      <p>Este documento es una representación oficial del acta de nacimiento.</p>
    </div>
  </div>
</body>
</html>
