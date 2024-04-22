<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
// j'inclus ici l'integralité du fichier controllers/login.php,
//  toutes les fonctions, variable et tout le reste seront disponible dans ce fichier
include_once '../controllers/login.php';
?>

<body>
    <header>
        <h1>connexion</h1>
        <a href="./subscribe.php">S'inscrire</a>
    </header>
    <form action="" method="POST">
        <div>
             <?php
            // ici, j'affiche l'erreur si elle existe, sinon une chaine vide. c'est une ternaire
            echo isset($errors['mail']) ? "<p>" . $errors['mail'] . "</p>" : '';
            ?>
            <label for="mail">email:</label>
            <input type="email" id="mail" name="mail">
        </div>
        <div>
        <?php
            echo isset($errors['password']) ? "<p>" . $errors['password'] . "</p>" : '';
            ?>
            <label for="password">mot de passe :</label>
            <input type="password" id="password" name="password">
            <button type="button" id="toggleButton" onclick="togglePasswordVisibility()">afficher le mot de passe</button>
        </div>
        <button type="submit">Valider</button>
    </form>
    <script>
        function togglePasswordVisibility() {
            let passwordInput = document.getElementById("password");
            let toggleButton = document.getElementById("toggleButton");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.innerHTML = "Masquer le mot de passe";
            } else {
                passwordInput.type = "password";
                toggleButton.innerHTML = "Afficher le mot de passe";
            }
        }
    </script>
</body>

</html>