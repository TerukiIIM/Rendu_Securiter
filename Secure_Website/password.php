<?php
    $plainPassword = "123";

    $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT, []);

    echo "<p>" . $plainPassword . " devient ". $hashedPassword . "</p>";

    if (password_verify("123", $hashedPassword)) {
        echo "<p>Le mot de passe est correct</p>";
    } else {
        echo "<p>Le mot de passe est incorrect</p>";
    }
?>