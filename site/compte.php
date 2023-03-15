<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="compte.css">
        <title>Alibabouche - compte</title>
    </head>
    
    <header>
        <a href="index.html" class="logo">Alibabouche</a>
        <ul>
            <li><a href="panier.php"><img src="images/panier.png" width="30px" height="30px"></li></a>
        </ul>
    </header>

    <body>
        <?php
            if(isset($_SESSION['login']) && $_SESSION['login'] != NULL){
            ?>
            <div id="principalInfo">
                <a id="connect_b"><?php echo $_SESSION['nom'], ' ', $_SESSION['prenom']; ?></a>
            </div>
            <div id="deconnect">
                <a id="deconnect_b" href="php/disconnect.php">Se déconnecter</a>
            </div>
            <?php
        }else{
            ?>
            <div id="principalInfo">
                <a id="connect_b" href="login.html">Se connecter</a>
            </div>
            <?php
            }
        ?>
        <!-- 
            <?php
            if(isset($_SESSION['login']) && $_SESSION['login'] != NULL){
            ?>
            <div id="main">
                <a>E-mail: </a>
            </div>
            <?php
            }
        ?> -->
    </body>
</html>