<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .container { width: 100%; padding: 15px; }
        .title { font-size: 22px; text-align: center; font-weight: bold; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        td { border: 1px solid #444; padding: 8px; }
        .bold { font-weight: bold; }
        .right { text-align: right; }
    </style>
</head>
<body>

<div class="container">

    <div class="title">REÇU DE PAIEMENT</div>

    <p><strong>Reçu N° :</strong> {{ $paiement->id_paiement }}</p>
    <p><strong>Date :</strong> {{ date('d/m/Y') }}</p>

    <p><strong>Étudiant :</strong> 
        {{ $paiement->inscription->etudiant->nom }}
        {{ $paiement->inscription->etudiant->prenom }}
    </p>

    <p><strong>Inscription :</strong> #{{ $paiement->id_inscription }}</p>

    <table>
        <tr>
            <td class="bold">Montant payé</td>
            <td class="right">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
        </tr>

        <tr>
            <td class="bold">Mode de paiement</td>
            <td class="right">{{ $paiement->mode_paiement }}</td>
        </tr>

        <tr>
            <td class="bold">Date du paiement</td>
            <td class="right">{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>
        </tr>
    </table>

    <p style="margin-top: 25px; text-align: center;">
        Merci pour votre confiance.<br>
    </p>

</div>

</body>
</html>
