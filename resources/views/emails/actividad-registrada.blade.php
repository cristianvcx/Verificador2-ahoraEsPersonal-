@php
    $hora = now()->hour;
    $saludo = ($hora < 12) ? 'días' : 'tardes';
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333;">
    <p>Buenos {{ $saludo }}.</p>

    <p>Junto con saludar, por medio del presente se remite información adjunta correspondiente a los verificadores de la actividad de promoción realizada, para los fines que estime pertinentes.</p>

    <p><strong>Antecedentes de la actividad:</strong></p>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 5px 0; width: 200px;"><strong>Fecha actividad:</strong></td>
            <td>{{ \Carbon\Carbon::parse($actividad->fecha_actividad)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;"><strong>Unidad responsable:</strong></td>
            <td>{{ $actividad->unidad_operativa }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;"><strong>N° ID de ingreso en sistema:</strong></td>
            <td>#{{ $actividad->actividad_id }}</td>
        </tr>
    </table>

<p style="margin-top: 20px;">
        <a href="{{ route('admin.actividades', ['id' => $actividad->actividad_id]) }}" 
           style="background-color: #0059c2; color: white; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;">
            REVISAR ACTIVIDAD EN SISTEMA
        </a>
    </p>

    <p style="margin-top: 20px;">Sin otro particular, saluda atentamente,</p>

<p>
        Atte:<br>
        <strong>{{ $actividad->usuario->persona->nombre_completo ?? $actividad->usuario->usuario_nombre }}</strong>
    </p>
</body>
</html>