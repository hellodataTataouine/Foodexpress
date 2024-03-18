<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'inscription</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Bienvenue, {{ $clientFirstName }} {{ $clientLastName }} !</h1>

    <p>Nous sommes ravis de vous informer que votre inscription a été confirmée avec succès sur Salade &amp; Cie.</p>

    <p>Votre compte a été créé avec les informations suivantes :</p>

    <ul>
        <li><strong>Nom :</strong> {{ $clientLastName }}</li>
        <li><strong>Prénom :</strong> {{ $clientFirstName }}</li>
        <li><strong>Email :</strong> {{ $email }}</li>
        <!-- Add more user details as needed -->
    </ul>

    <p>Vous pouvez maintenant profiter de nos services en ligne. Nous sommes impatients de vous servir à nouveau.</p>

    <footer>
        <p>Cordialement,<br>L'équipe de Salade &amp; Cie.</p>
    </footer>
</body>
</html>
