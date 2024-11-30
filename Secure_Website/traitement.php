<?php
    session_start();

    // On verifie le scrf token avant quoi que ce soit
    if (isset($_POST["token"]) && $_POST["token"] != $_SESSION["csrf_article_add"]) {
        die("<p>CSRF invalide</p>");
    }

    // Supprime le token en session pour qu'il soit régénéré
    unset($_SESSION["csrf_article_add"]);

    if (isset($_POST["title"]) && !empty($_POST["title"])) {
        $title = htmlspecialchars($_POST["title"]);
    } else {
        echo "<p>Le titre est obligatoire</p>";
    }

    if (isset($_POST["content"]) && !empty($_POST["content"])) {
        $content = htmlspecialchars($_POST["content"]);
    } else {
        echo "<p>Le contenu est obligatoire</p>";
    }

    if (isset($_POST["slug"]) && !empty($_POST["slug"])) {
        $slug = htmlspecialchars($_POST["slug"]);
    } else {
        echo "<p>Le slug est obligatoire</p>";
    }

    if (isset($title) && isset($content) && isset($slug)) {
        // Pas d'erreur => on sauvegarde l'article
        require_once "bdd.php";

        // Vérifier le slug (pas de caractères spéciaux ni d'espaces)

        $sauvegarde = $connexion->prepare("INSERT INTO article (title, content, slug) VALUES (:title, :content, :slug)");
        $sauvegarde->execute([
            "title" => $title,
            "content" => $content,
            "slug" => $slug
        ]);

        if ($sauvegarde->rowCount() > 0) {
            echo "<p>L'article a bien été sauvegardé</p>";
        } else {
            echo "<p>Erreur lors de la sauvegarde de l'article</p>";
        }
    }
?>