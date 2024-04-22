<?php
// j'inclus ici l'integralité du fichier controllers/subscribe.php,
//  toutes les fonctions, variable et tout le reste seront disponible dans ce fichier
include_once '../controllers/subscribe.php'; 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>inscription</h1>
        <a href="./login.php">se connecté</a>
    </header>
    <form action="" method="POST">
        <div>
            <?php
            // ici, j'affiche l'erreur si elle existe, sinon une chaine vide. c'est une ternaire
            echo isset($errors['name']) ? "<p>" . $errors['name'] . "</p>" : '';
            ?>
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value='<?php echo !empty($_POST['name']) ? $_POST['name'] : ''; ?>'>
        </div>
        <div>
        <?php
            echo isset($errors['firstname']) ? "<p>" . $errors['firstname'] . "</p>" : '';
            ?>
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" value='<?php echo !empty($_POST['firstname']) ? $_POST['firstname'] : ''; ?>'>
        </div>
        <div>
        <?php
            echo isset($errors['mail']) ? "<p>" . $errors['mail'] . "</p>" : '';
            ?>
            <label for="mail">Email :</label>
            <input type="email" id="mail" name="mail" value='<?php echo !empty($_POST['mail']) ? $_POST['mail'] : ''; ?>'>
        </div>
        <div>
        <?php
            echo isset($errors['password']) ? "<p>" . $errors['password'] . "</p>" : '';
            ?>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password">
            <button type="button" id="toggleButton" onclick="togglePasswordVisibility()">Afficher le mot de passe</button>
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