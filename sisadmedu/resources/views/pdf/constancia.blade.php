<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Constancia de Estudio</title>
    <link href="{{ public_path('css/estilos-pdf/pdf.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        <img src="{{ public_path('images/Logo SISADMEDU.jpg') }}" alt="Logo" class="logo">
        <h2>Constancia de Estudio</h2>
        <p>Institución Alfonso López Pumarejo</p>
    </div>

   <!-- Contenido de la constancia -->
   <div class="contenido">
    La presente certifica que el(la) estudiante <strong>{{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->segundo_nombre_estudiante }} {{ $estudiante->primer_apellido_estudiante }} {{ $estudiante->segundo_apellido_estudiante }}</strong>,
    identificado(a) con documento de identidad N.° <strong>{{ $estudiante->documento_estudiante }}</strong>,
    se encuentra debidamente matriculado(a) y cursando el grado <strong>{{ $estudiante->grado->nombre_grado }}</strong> en la
    <strong>Institución Educativa Alfonso López Pumarejo</strong>, durante el presente año lectivo.

    <br><br>
    Esta constancia se expide a solicitud del interesado(a) para los fines que estime convenientes, y se firma en la ciudad de
    <strong>Medellín, Antioquia</strong>, a los 
    <strong>{{ now()->format('d') }}</strong> días del mes de 
    <strong>{{ \Carbon\Carbon::now()->locale('es')->isoFormat('MMMM') }}</strong> 
    del año <strong>{{ now()->format('Y') }}</strong>.


    <br><br>
    Se deja constancia de que la información aquí consignada corresponde a los registros oficiales de la institución y tiene plena validez para trámites académicos, administrativos o legales que así lo requieran.
   </div>


    <!-- Firma -->
    <div class="firma">
        <img src="{{ public_path('images/firma.png') }}" alt="Firma">
        <br>
        Firma y Sello<br>
        {{ now()->format('d/m/Y') }}
    </div>

    <!-- Pie de página -->
    <footer>
        Sistema SISADMEDU - Documento generado automáticamente
    </footer>
</body>
</html>
