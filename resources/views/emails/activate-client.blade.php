<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ative sua conta</title>
</head>
<body>
    <h1>Olá, {{ $client->name }}</h1>
    <p>Obrigado por se cadastrar! Por favor, clique no link abaixo para ativar sua conta:</p>
    <p><a href="{{ $activationUrl }}">Ativar Conta</a></p>
    <p>Se você não se cadastrou, ignore este e-mail.</p>
</body>
</html>

