<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código de recuperación</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:20px;">

    <div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">

        <h2 style="color:#2c3e50;">🔑 Recuperación de contraseña</h2>

        <p>Hola <strong>{{ $usuario->nombres ?? 'Usuario' }}</strong>,</p>

        <p>Hemos recibido una solicitud para restablecer tu contraseña.  
        Usa el siguiente código para continuar con el proceso:</p>

        <div style="background:#2c3e50; color:white; padding:15px; border-radius:8px; font-size:24px; text-align:center; letter-spacing:5px;">
            <strong>{{ $code }}</strong>
        </div>

        <p style="margin-top:20px;">Este código expirará en 10 minutos.</p>

        <p>Si tú no solicitaste este cambio, puedes ignorar este mensaje.</p>

        <hr style="margin-top:20px;">
        <p style="font-size:12px; color:#7f8c8d;">Este mensaje fue enviado automáticamente por el sistema SISADMEDU.</p>
    </div>

</body>
</html>
