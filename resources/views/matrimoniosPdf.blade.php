<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Acta de Matrimonio</title>
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
    <h1>Acta de Matrimonio</h1>
    <h2>Fecha de impresión: {{$fecha_actual}}</h2>

    <div class="section">
      <div class="section-title">Detalles del Acta</div>
      <div class="details">
        <p><span class="label">Fecha del acta:</span> {{$acta->fecha_registro}}</p>
        <p><span class="label">Libro:</span> {{$acta->folio->libro_id}}</p>
        <p><span class="label">Folio:</span> {{$acta->folio_id}}</p>
        <p><span class="label">Acta:</span> {{$acta->id_acta ?? $acta->identificador}}</p>
        <p><span class="label">Fecha de matrimonio:</span> {{$acta->actaMatrimonio->fecha_matrimonio ?? ''}}</p>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Información de los Novios</div>
      <div class="details">
        <p><span class="label">Novio:</span> {{$novio->nombre}} {{$novio->apellido}}</p>
        <p><span class="label">Novia:</span> {{$novia->nombre}} {{$novia->apellido}}</p>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Testigos</div>
      <div class="details">
        <p><span class="label">Testigo 1:</span> {{$testigo1->nombre}} {{$testigo1->apellido}}</p>
        <p><span class="label">Testigo 2:</span> {{$testigo2->nombre}} {{$testigo2->apellido}}</p>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Funcionario Responsable</div>
      <div class="details">
        <p><span class="label">Registrado por:</span> {{$funcionario->persona->nombre ?? $funcionario->name}} {{$funcionario->persona->apellido ?? ''}}</p>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Alcalde</div>
      <div class="details">
        <p><span class="label">Nombre:</span> {{$alcalde->nombre}} {{$alcalde->apellido}}</p>
      </div>
    </div>

    <div class="footer">
      <p>Este documento es una representación oficial del acta de matrimonio.</p>
    </div>
  </div>
</body>
</html>
