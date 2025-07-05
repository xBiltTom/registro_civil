<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Acta de Defunción</title>
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
    <h1>Acta de Defunción</h1>
    <h2>Fecha de impresión: {{$fecha_actual}}</h2>

    <div class="section">
      <div class="section-title">Detalles del Acta</div>
      <div class="details">
        <p><span class="label">Fecha del acta:</span> {{$acta->fecha_registro}}</p>
        <p><span class="label">Libro:</span> {{$acta->folio->libro_id}}</p>
        <p><span class="label">Folio:</span> {{$acta->folio_id}}</p>
        <p><span class="label">Acta:</span> {{$acta->identificador}}</p>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Información del Fallecido</div>
      <div class="details">
        <p><span class="label">Nombre:</span> {{$fallecido->nombre}} {{$fallecido->apellido}}</p>
        <p><span class="label">Fecha de fallecimiento:</span> {{$acta->actaDefuncion->fecha_defuncion}}</p>
        <p><span class="label">Detalles del fallecimiento:</span> {{$acta->actaDefuncion->detalle}}</p>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Información del Declarante</div>
      <div class="details">
        <p><span class="label">Nombre:</span> {{$declarante->nombre}} {{$declarante->apellido}}</p>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Funcionario Responsable</div>
      <div class="details">
        <p><span class="label">Registrado por:</span> {{$funcionario->persona->nombre}} {{$funcionario->persona->apellido}}</p>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Alcalde</div>
      <div class="details">
        <p><span class="label">Nombre:</span> {{$alcalde->nombre}} {{$alcalde->apellido}}</p>
      </div>
    </div>

    <div class="footer">
      <p>Este documento es una representación oficial del acta de defunción.</p>
    </div>
  </div>
</body>
</html>
