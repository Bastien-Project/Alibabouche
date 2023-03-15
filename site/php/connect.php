<?php
$pageToGo = '../login.html';

require_once('functions.php');
$dbh = getPDO();

session_start();

$sth = $dbh->query('SELECT * FROM login');
$resultset = $sth->fetchAll();

foreach($resultset as $value){
    if($value['user'] == $_POST['nom'] and $value['pwd'] == $_POST['passwd']){
        $pageToGo = '../compte.php';
        $_SESSION['prenom'] = $value['prenom'];
        $_SESSION['nom'] = $value['nom'];
        $_SESSION['login'] = $_POST['nom']; 
    }
}

//close
$sth = null;
$dbh = null;

header("Location: " . $pageToGo);
?>