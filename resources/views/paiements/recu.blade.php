<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 14px; 
            margin: 0; 
            padding: 0; 
            background: #f5f5f5;
            display: flex;
            /* justify-content: center;
            align-items: center; */
            texte-align: left;
        }

        .receipt-container {
            width: 700px;
            margin: 0px auto;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            margin-bottom: 25px;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #007bff;
        }

        .info p {
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #444;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #007bff;
            color: white;
            text-align: center;
        }

        .right { text-align: right; }
        .center { text-align: center; font-weight: bold; }

        .signature {
            margin-top: 40px;
            text-align: right;
            padding-right: 50px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #555;
        }

        .status {
            padding: 2px 5px;
            display: inline-block;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
            font-size: 13px;
        }

        .paid {
            background-color: #28a745;
            color: white;
        }

        .partial {
            background-color: #ffc107;
            color: black;
        }

        .unpaid {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<div class="receipt-container">

    <div class="header">
        <h1>REÇU DE PAIEMENT</h1>
        <p>Académie de Langues - Gestion des Inscriptions</p>
    </div>

    <div class="info">
        <p><strong>Reçu N° :</strong> {{ $paiement->id_paiement }}</p>
        <p><strong>Date d'émission :</strong> {{ date('d/m/Y') }}</p>

        <p><strong>Nom de l'étudiant :</strong> 
            {{ $paiement->inscription->etudiant->nom }}
            {{ $paiement->inscription->etudiant->prenom }}
        </p>

        <p><strong>Niveau concerné :</strong> 
            {{ $paiement->inscription->niveau->nom_niveaux }}
        </p>

        <p><strong>Numéro d'inscription :</strong> #{{ $paiement->id_inscription }}</p>

        {{-- Statut du paiement --}}
        @php
            $statut = '';
            $reste = $paiement->inscription->montant_restant;
            if ($reste == 0) {
                $statut = '<span class="status paid">PAYÉ</span>';
            } elseif ($reste > 0 && $paiement->inscription->montant_verse > 0) {
                $statut = '<span class="status partial">PARTIELLEMENT PAYÉ</span>';
            } else {
                $statut = '<span class="status unpaid">NON PAYÉ</span>';
            }
        @endphp

        <p><strong>Statut du Paiement :</strong> {!! $statut !!}</p>
    </div>

    <table>
        <tr>
            <th>Désignation</th>
            <th class="right">Montant (FCFA)</th>
        </tr>
        <tr>
            <td>Frais total du niveau</td>
            <td class="right">{{ number_format($paiement->inscription->montant_total, 0, ',', ' ') }}</td>
        </tr>
        <tr>
            <td>Montant déjà payé</td>
            <td class="right">
                {{ number_format(($paiement->inscription->montant_verse - $paiement->montant), 0, ',', ' ') }}
            </td>
        </tr>
        <tr>
            <td><strong>Montant payé</strong></td>
            <td class="right"><strong>{{ number_format($paiement->montant, 0, ',', ' ') }}</strong></td>
        </tr>
        <tr>
            <td>Montant total payé</td>
            <td class="right">{{ number_format($paiement->inscription->montant_verse, 0, ',', ' ') }}</td>
        </tr>
        <tr>
            <td><strong>Reste à payer</strong></td>
            <td class="right"><strong>{{ number_format($paiement->inscription->montant_restant, 0, ',', ' ') }}</strong></td>
        </tr>
    </table>

    <p style="margin-top: 15px;"><strong>Mode de paiement :</strong> {{ $paiement->mode_paiement }}</p>
    <p><strong>Date du paiement :</strong> {{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</p>

    <div class="signature">
        <p><strong>Signature & Cachet</strong></p>
        <br><br>
        <p>_________________________</p>
    </div>

    <div class="footer">
        Merci pour votre confiance.<br>
        Direction - Académie de Langues
    </div>

</div>

</body>
</html>
