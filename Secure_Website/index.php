<?php
    session_start();

    // Si on n'a pas de csrf token, on en crée un
    if (!isset($_SESSION["csrf_article_add"]) || empty($_SESSION["csrf_article_add"])) {
        $_SESSION["csrf_article_add"] = bin2hex(random_bytes(32));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="traitement.php" method="POST">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" placeholder="Article 1">
        <br>
        <label for="content">Contenu :</label>
        <textarea name="content" id="content" rows="10" cols="30"></textarea>
        <br>
        <label for="slug">Slug :</label>
        <input type="text" name="slug" id="slug" placeholder="article-1">
        <br>
        <input type="hidden" name="token" value="<?php echo $_SESSION["csrf_article_add"]; ?>">
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</body>
</html>