<?php

function getPDO() {
    $user = "root";
    $pass = "root";

    $db = null;
    try {
        $db = new PDO('mysql:host=localhost;dbname=login', $user, $pass);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    return $db;
}