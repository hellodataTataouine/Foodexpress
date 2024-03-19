<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Envoi Email</title>
</head>
<body>
    {{-- <h1>Nom : Marwen</h1>
    <h2>Numéro du téléphone : 54270128</h2>
    <h2>Adresse E-mail : jaabermarwen@gmail.com</h2>
    <p>5alouni 8ar 5alouni</p> --}}
    {{-- <h1>{{ dd($name)}}</h1> --}}
    <h1>Nom : {{  $name }}</h1>
    <h2>Numéro du téléphone : {{ $phone_number}}</h2>
    <h2>Adresse E-mail : {{ $email }}</h2>
    <p>{{ $msg }}</p>
</body>
</html>