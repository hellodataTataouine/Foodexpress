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
    <h1>Cher(e) {{ $clientFirstName }} {{ $clientLastName }},</h1>

    <h2>Nous sommes ravis de vous informer que votre commande a été confirmée avec succès.</h2>

    <ul style="font-size: 18px;">
    <li><strong>Numéro de commande :</strong> {{ $commandId }}</li>
    <li><strong>Date de commande :</strong> {{ $currentDateTime }}</li>
    <li><strong>Produits commandés :</strong></li>
</ul>

<table style="font-size: 18px; width: 100%;">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $item)
            @if (!empty($item['options']))
                @if (is_array($item['options']))
                    <tr>
                        <td>
                            {{ $item['name'] }}<br>
                            Options:
                            @foreach ($item['options'] as $index => $option)
                                @if ($index == 0)
                                @endif
                                {{ $option['name'] }} ({{ $option['quantity'] }} x {{ $option['price'] }} €)@if (!$loop->last), @endif
                                @if (($index + 1) % 5 == 0) <br> @endif
                            @endforeach
                        </td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }} €</td>
                    </tr>
                @else
                    @php
                    $options = explode(', ', $item['options']);
                    @endphp
                    <tr>
                        <td>
                            {{ $item['name'] }}<br>
                            Options:
                            @foreach ($options as $index => $option)
                                @if ($index == 0)
                                @endif
                                {{ $option }}@if ($index < count($options) - 1), @endif
                                @if (($index + 1) % 5 == 0) <br> @endif
                            @endforeach
                        </td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }} €</td>
                    </tr>
                @endif
            @else
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price'] }} €</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>


    <h2>Montant total TTC : {{ $totalPrice }} €</h2>

    <h2>Nous sommes impatients de vous servir à nouveau.</h2>

    <p style="font-size: 16px;">Cordialement</p>
</body>
</html>
