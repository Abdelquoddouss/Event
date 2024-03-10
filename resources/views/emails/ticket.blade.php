<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            padding: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            margin-top: 20px;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Confirmation de réservation</div>
        <div class="content">
            <p>Bonjour {{ $reservation->user->name }},</p>
            <p>Votre réservation pour l'événement <strong>{{ $reservation->event->titre }}</strong> a été <strong>acceptée</strong>.</p>
            <p>Détails de l'événement :</p>
            <ul>
                <li>Date : {{ $reservation->event->date }}</li>
                <li>Lieu : {{ $reservation->event->lieux }}</li>
                <li>Catégorie : {{ $reservation->event->categorie->name }}</li>
            </ul>
            <p>Vous trouverez votre ticket en pièce jointe à cet email.</p>
        </div>
        <div class="footer">
            Merci d'utiliser notre service de réservation d'événements !
        </div>
    </div>
</body>
</html>
