<?php
$host = 'localhost';
$dbname = 'alibabouche';
$user = 'root';
$pass = ''; // à adapter

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}


// Catégories prédéfinies
$categories = [
    "Boissons et Alimentation" => "Boissons_et_Alimentation",
    "Maison et Jardin" => "Maison_et_Jardin",
    "Art" => "Art",
    "Bricolage" => "Bricolage",
    "Voyage" => "Voyage",
    "Autres" => "Autres"
];

// === AJOUT ou MODIFICATION ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $caracteristique = $_POST['caracteristique'];
    $note = $_POST['note'];
    $imagePath = $_POST['existing_image'] ?? null;

    // Upload d'image si nouveau fichier
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/' . $categories[$categorie] . '/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    if ($id) {
        // Modification
        $stmt = $pdo->prepare("UPDATE produits SET categorie=:categorie, image=:image, prix=:prix, titre=:titre,
            description=:description, caracteristique=:caracteristique, note=:note WHERE id=:id");

        $stmt->execute([
            ':categorie' => $categorie,
            ':image' => $imagePath,
            ':prix' => $prix,
            ':titre' => $titre,
            ':description' => $description,
            ':caracteristique' => $caracteristique,
            ':note' => $note,
            ':id' => $id
        ]);
    } else {
        // Ajout
        $stmt = $pdo->prepare("INSERT INTO produits (categorie, image, prix, titre, description, caracteristique, note)
            VALUES (:categorie, :image, :prix, :titre, :description, :caracteristique, :note)");

        $stmt->execute([
            ':categorie' => $categorie,
            ':image' => $imagePath,
            ':prix' => $prix,
            ':titre' => $titre,
            ':description' => $description,
            ':caracteristique' => $caracteristique,
            ':note' => $note
        ]);
    }
    header("Location: admin.php");
    exit;
}

// === SUPPRESSION ===
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php");
    exit;
}

// === ÉDITION ===
$editing = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
    $stmt->execute([$id]);
    $editing = $stmt->fetch(PDO::FETCH_ASSOC);
}

// === RÉCUPÉRATION DE TOUS LES PRODUITS ===
$produits = $pdo->query("SELECT * FROM produits ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des Produits</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        form { margin: 20px 0; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 5px; }
        img { height: 60px; }
        .actions a { margin: 0 5px; }
    </style>
</head>
<body>
    <h2><?= $editing ? "Modifier le produit #" . $editing['id'] : "Ajouter un produit" ?></h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $editing['id'] ?? '' ?>">
        <input type="hidden" name="existing_image" value="<?= $editing['image'] ?? '' ?>">

        <label>Titre :
            <input type="text" name="titre" value="<?= $editing['titre'] ?? '' ?>" required>
        </label><br><br>

        <label>Prix :
            <input type="number" name="prix" step="0.01" value="<?= $editing['prix'] ?? '' ?>" required>
        </label><br><br>

        <label>Catégorie :
            <select name="categorie" required>
                <?php foreach ($categories as $key => $folder): ?>
                    <option value="<?= $key ?>" <?= (isset($editing['categorie']) && $editing['categorie'] === $key) ? 'selected' : '' ?>>
                        <?= $key ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <label>Image :
            <input type="file" name="image" accept="image/*">
            <?php if (!empty($editing['image'])): ?>
                <br><img src="<?= $editing['image'] ?>" alt="Aperçu">
            <?php endif; ?>
        </label><br><br>

        <label>Description :
            <textarea name="description"><?= $editing['description'] ?? '' ?></textarea>
        </label><br><br>

        <label>Caractéristiques :
            <textarea name="caracteristique"><?= $editing['caracteristique'] ?? '' ?></textarea>
        </label><br><br>

        <label>Note :
            <input type="number" name="note" min="0" max="5" step="0.1" value="<?= $editing['note'] ?? 0 ?>">
        </label><br><br>

        <button type="submit"><?= $editing ? "Mettre à jour" : "Ajouter" ?></button>
    </form>

    <h2>Liste des produits</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Titre</th><th>Catégorie</th><th>Prix</th><th>Image</th><th>Note</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['titre']) ?></td>
                    <td><?= $p['categorie'] ?></td>
                    <td><?= number_format($p['prix'], 2) ?> €</td>
                    <td>
                        <?php if ($p['image']): ?>
                            <img src="<?= $p['image'] ?>" alt="image">
                        <?php endif; ?>
                    </td>
                    <td><?= $p['note'] ?>/5</td>
                    <td class="actions">
                        <a href="?edit=<?= $p['id'] ?>">✏️</a>
                        <a href="?delete=<?= $p['id'] ?>" onclick="return confirm('Supprimer ce produit ?')">🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>