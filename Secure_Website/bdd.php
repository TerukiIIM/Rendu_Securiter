<?php
    try {
        $connexion = new PDO("mysql:host=localhost; dbname=secure", "root", "");
    } catch (Exception $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
?>