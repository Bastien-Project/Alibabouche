<?php include 'header.php'; ?>

<?php
$pdo = new PDO("mysql:host=localhost;dbname=alibabouche;charset=utf8mb4", "root", "");

// Catégories autorisées
$categories = [
    "Boissons",
    "Maison et Jardin",
    "Art",
    "Bricolage",
    "Voyage",
    "Autres"
];

// Récupère la catégorie depuis l'URL
$categorie = $_GET['categorie'] ?? null;

if (!$categorie || !in_array($categorie, $categories)) {
    echo "<div class='drink'><h2>Catégorie inconnue</h2><p>Veuillez sélectionner une catégorie valide.</p></div>";
    header("Location: index.php");
    include 'footer.php';
    exit;
}

// Récupère les produits de la catégorie
$stmt = $pdo->prepare("SELECT * FROM produits WHERE categorie = :categorie ORDER BY id ASC");
$stmt->execute(['categorie' => $categorie]);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="drink">
    <h2>Nos <?= htmlspecialchars($categorie) ?></h2>
    <p>Découvrez notre sélection de produits dans la catégorie "<?= htmlspecialchars($categorie) ?>".</p>
</div>

<?php foreach ($produits as $p): ?>
    <div class="product">
        <div class="product-main">
            <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['titre']) ?>">
            <div class="product-info">
                <h3><?= htmlspecialchars($p['titre']) ?></h3>
                <p class="description"><?= htmlspecialchars($p['description']) ?></p>
                <p class="price">Prix : <?= number_format($p['prix'], 2) ?>€</p>
                <button type="button">Ajouter au panier</button>
            </div>
        </div>
        <div class="product-extra">
            <p><strong>Caractéristiques :</strong> <?= nl2br(htmlspecialchars($p['caracteristique'])) ?></p>
            <p><strong>Note client :</strong> <?= str_repeat("★", round($p['note'])) . str_repeat("☆", 5 - round($p['note'])) ?> (<?= number_format($p['note'], 1) ?>/5)</p>
        </div>
    </div>
<?php endforeach; ?>

<?php if (empty($produits)): ?>
    <p style="text-align:center;">Aucun produit trouvé dans cette catégorie.</p>
<?php endif; ?>

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