<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
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
        <p style="font-size: 18px;">Cher(e) <strong>{{ $clientFirstName }} {{ $clientLastName }}</strong></p>
        <p style="font-size: 18px;">Nous avons le plaisir de vous informer que votre commande <strong> N° {{ $commandId }}</strong> est prête.</p>
        <!-- Ajoutez plus de détails de commande au besoin -->
        <p style="font-size: 18px;">Prix Total : <strong>{{ $totalPrice }} €</strong></p>
        <p style="font-size: 18px;">Merci d'avoir choisi notre service !</p>
        <p style="font-size: 18px;">Cordialement
      </body>

	
	
</html>
