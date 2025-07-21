<?php include 'header.php'; ?>

<div class="drink">
    <h2>Nos boissons</h2>
    <p>Découvrez notre sélection de boissons artisanales, locales et éthiques. Chaque gorgée est une célébration du savoir-faire et de la passion des producteurs.</p>
</div>

<div class="product">
    <div class="product-main">
        <img src="images/drinkImage/sticule.png" alt="Thé Sticule">
        <div class="product-info">
            <h3>Thé Sticule</h3>
            <p class="description">Un thé bio, avec des arômes de fromage, pour une expérience unique.</p>
            <p class="price">Prix : 15,00€</p>
            <button type="button">Ajouter au panier</button>
        </div>
    </div>
    <div class="product-extra">
        <p><strong>Caractéristiques :</strong> 100% bio, sans théine, arôme naturel</p>
        <p><strong>Note client :</strong> ★★★★☆ (4.2/5)</p>
    </div>
</div>

<div class="product">
    <div class="product-main">
        <img src="images/drinkImage/monthe_cristaux.png" alt="MenThé Cristaux">
        <div class="product-info">
            <h3>MenThé Cristaux</h3>
            <p class="description">Du thé à base de menthe et cristaux de menthe, pour une fraîcheur inégalée.</p>
            <p class="price">Prix : 10,00€</p>
            <button type="button">Ajouter au panier</button>
        </div>
    </div>
    <div class="product-extra">
        <p><strong>Caractéristiques :</strong> Infusion glacée, zéro sucre, intense</p>
        <p><strong>Note client :</strong> ★★★★★ (4.8/5)</p>
    </div>
</div>

<div class="product">
    <div class="product-main">
        <img src="images/drinkImage/schwitz.jpg" alt="Eau Schwitz">
        <div class="product-info">
            <h3>Eau Schwitz</h3>
            <p class="description">Une eau provenant d'une source en Pologne, naturellement gazéifiée, pour une hydratation optimale.</p>
            <p class="price">Prix : 19,40€</p>
            <button type="button">Ajouter au panier</button>
        </div>
    </div>
    <div class="product-extra">
        <p><strong>Caractéristiques :</strong> Eau minérale, gaz naturel, bouteille recyclable</p>
        <p><strong>Note client :</strong> ★★★☆☆ (3.7/5)</p>
    </div>
</div>

<style>
    .drink {
        text-align: center;
        margin: 20px;
    }

    .product {
        border: 1px solid #ccc;
        padding: 15px;
        margin: 20px auto;
        max-width: 800px;
        background-color: #f9f9f9;
    }

    .product-main {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }

    .product img {
        width: 120px;
        height: auto;
        object-fit: cover;
        border-radius: 5px;
    }

    .product-info {
        flex-grow: 1;
    }

    .product-info h3 {
        margin-top: 0;
    }

    .product-info .price {
        font-weight: bold;
        color: #333;
    }

    .product-info button {
        background-color: #E7AD1A;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        margin-top: 10px;
        border-radius: 4px;
    }

    .product-info button:hover {
        background-color: #d69a1a;
    }

    .product-extra {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #ddd;
        font-size: 0.95em;
    }
</style>

<?php include 'footer.php'; ?>
