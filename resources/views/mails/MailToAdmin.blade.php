<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail admin</title>
</head>
<body>
    <h1>hai ricevuto un email da: {{ $lead->name }}</h1>
    <h2>La sua email: {{ $lead->email }}</h2>
    <p>Messaggio: {{ $lead->message }}</p>
</body>
</html>