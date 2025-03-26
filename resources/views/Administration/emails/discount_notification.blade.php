<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotion exclusive sur {{ $product->name }} | Wuras</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .product-name {
            color: #e74c3c;
            font-weight: bold;
        }
        .price-container {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            text-align: center;
        }
        .original-price {
            color: #7f8c8d;
            text-decoration: line-through;
        }
        .discounted-price {
            color: #27ae60;
            font-size: 22px;
            font-weight: bold;
        }
        .discount-badge {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }
        .cta-button {
            display: block;
            width: 80%;
            max-width: 250px;
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 12px 20px;
            margin: 25px auto;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .cta-button:hover {
            background-color: #2980b9;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <!-- Remplacez par votre logo -->
            <img src="{{ asset('front/logo.webp') }}" alt="Wuras Logo" class="logo">
        </div>
        
        <h1>🎉 Promotion exceptionnelle sur <span class="product-name">{{ $product->name }}</span> !</h1>
        
        <div style="text-align: center;">
            <div class="discount-badge">Économisez {{ number_format($product->discount, 0) }} FCFA</div>
        </div>
        
        <div class="price-container">
            <p>Prix initial: <span class="original-price">{{ number_format($product->price, 0) }} FCFA</span></p>
            <p>Nouveau prix: <span class="discounted-price">{{ number_format($product->price - $product->discount, 0) }} FCFA</span></p>
        </div>
        
        <p style="text-align: center;">Profitez de cette offre avant qu'elle ne disparaisse ! Cette promotion est valable pour une durée limitée.</p>
        
        <a href="https://wuras.ci/magasin/{{ $product->slug }}" class="cta-button">VOIR LE PRODUIT</a>
        
        <div class="footer">
            <p>Merci pour votre confiance,</p>
            <p><strong>L'équipe Wuras</strong></p>
            <p style="margin-top: 15px;">
                <a href="https://wuras.ci" style="color: #3498db; text-decoration: none;">wuras.ci</a>
            </p>
        </div>
    </div>
</body>
</html>