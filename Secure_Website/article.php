<?php 
    if (!isset($_GET["slug"]) || empty($_GET["slug"])) {
        die("<p>Article introuvable</p>");
    }

    // Connexion à la base de données
    require_once "bdd.php";

    $getArticle = $connexion->prepare("SELECT title, content FROM article WHERE slug = :slug LIMIT 1");
    $getArticle->execute([
        "slug" => htmlspecialchars($_GET["slug"])
    ]);

    if ($getArticle->rowCount() == 1) {
        $article = $getArticle->fetch();
        echo "<h1>" . $article["title"] . "</h1>";
        echo "<p>" . $article["content"] . "</p>";
    } else {
        echo "<p>Article introuvable</p>";
    }
?>