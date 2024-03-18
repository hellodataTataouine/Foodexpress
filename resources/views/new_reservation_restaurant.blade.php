<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Demande de Réservation de Table</title>
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
    <p style="font-size: 18px;">Cher(e) administrateur/administratrice de <strong>{{ $restaurant }}</strong>,</p>
    <p style="font-size: 18px;">Une nouvelle demande de réservation de table a été reçue.</p>
    
    <p style="font-size: 18px;">Détails de la réservation :
        <ul>
            <li>ID de la réservation : {{ $reservationId }}</li>
			 <li>Date de réservation : {{ $dateReservation }}</li>
			 <li>heures de la réservation : Entre {{ $heure_debut }} et {{heure_fin}}</li>
            <li>Nom du client : {{ $clientFirstName }} {{ $clientLastName }}</li>
            <li>Email du client : {{ $clientEmail }}</li>
            <li>Téléphone du client : {{ $clientNum1 }}</li>
			
            <!-- Ajoutez d'autres détails de réservation au besoin -->
        </ul>
    </p>

    <p style="font-size: 18px;">Merci de prendre les mesures nécessaires pour traiter cette demande.</p>
    
    <p style="font-size: 18px;">Cordialement.</p>
</body>
</html>
