<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation de table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 24px;
        }

        h2 {
            font-size: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>

	
	 <body>
    <p style="font-size: 18px;">Cher(e) <strong>{{ $clientFirstName }} {{ $clientLastName }}</strong>,</p>
<p style="font-size: 18px;">Votre réservation de table a été confirmée avec succès. Merci de nous avoir choisis !</p>
    <!-- Ajoutez plus de détails de commande au besoin -->
    <p style="font-size: 18px;">Cordialement, <br> L'equipe de {{ $restaurant }}.</p>
</body>

	
	
</html>
