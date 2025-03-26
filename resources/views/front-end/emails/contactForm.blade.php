<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact | Wuras</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            padding: 25px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-top: none;
        }
        .alert-badge {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 15px;
        }
        .details-box {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 15px;
            margin: 15px 0;
        }
        .detail-row {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        }
        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .detail-label {
            font-weight: bold;
            color: #2c3e50;
            display: inline-block;
            width: 120px;
        }
        .attachments {
            margin-top: 25px;
        }
        .attachment-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin-bottom: 8px;
        }
        .attachment-icon {
            margin-right: 10px;
            font-size: 20px;
        }
        .footer {
            margin-top: 25px;
            font-size: 12px;
            color: #7f8c8d;
            text-align: center;
        }
        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nouveau message de contact</h2>
    </div>
    
    <div class="content">
        <div class="alert-badge">À traiter</div>
        
        <div class="details-box">
            <div class="detail-row">
                <span class="detail-label">Date :</span>
                <span>{{ now()->format('d/m/Y H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Nom :</span>
                <span>{{ $name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email :</span>
                <span><a href="mailto:{{ $email }}">{{ $email }}</a></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Téléphone :</span>
                <span>{{ $telephone ?? 'Non renseigné' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Sujet :</span>
                <span>{{ $sujet }}</span>
            </div>
        </div>
        
        <h3>Message :</h3>
        <div class="details-box" style="white-space: pre-line;">{{ $content  }}</div>
        
        @if($pieces_jointes && count($pieces_jointes) > 0)
        <div class="attachments">
            <h3>Pièces jointes ({{ count($pieces_jointes) }}) :</h3>
            @foreach($pieces_jointes as $piece)
            <div class="attachment-item">
                <div class="attachment-icon">
                    @if(str_contains($piece['type'], 'pdf'))
                    📄
                    @elseif(in_array($piece['type'], ['jpg', 'jpeg', 'png', 'gif']))
                    🖼️
                    @else
                    📎
                    @endif
                </div>
                <div>
                    <div><strong>{{ $piece['nom'] }}</strong></div>
                    <div>{{ $piece['taille'] }} - {{ strtoupper($piece['type']) }}</div>
                    <div><a href="{{ $piece['url'] }}">Télécharger</a></div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <div style="text-align: center; margin-top: 25px;">
            <a href="mailto:{{ $email }}?subject=RE: {{ $sujet }}" class="button">Répondre à ce message</a>
        </div>
    </div>
    
    <div class="footer">
        <p>Ce message a été envoyé via le formulaire de contact de wuras.ci</p>
        <p>© {{ now()->year }} Wuras. Tous droits réservés.</p>
    </div>
</body>
</html>
