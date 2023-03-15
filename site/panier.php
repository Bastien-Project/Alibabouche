<?php
session_start();

require_once('php/functions.php');
$dbh = getPDO();


$sth = $dbh->query('SELECT * FROM `panier`');
$resultset = $sth->fetchAll();

$prixTotal = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="panier.css">
        <title>Alibabouche - compte</title>
    </head>
    <header>
        <a href="index.html" class="logo">Alibabouche</a>
        <ul>
            <li></li>
        </ul>
    </header>
    <body>
        <div id="title">
            <h1>Panier:</h1>
        </div>
        <div id="main">
            <?php
            foreach($resultset as $value){
                ?>
            <div id="rowArticle">
                <a><?php echo $value['id'] ?><a>
                <a><?php echo $value['nameArticle'] ?></a>
                <a><?php echo $value['prix'] ?>€<a>
                <?php $prixTotal = 0; ?>
            </div>
            <?php 
            } ?>
        </div>
        <a>Total: </a>
        <?php echo $value['prix'] ?>
    </body>
</html>