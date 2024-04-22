<?php
// j'inclus ici l'integralité du fichier controllers/login.php,
//  toutes les fonctions, variable et tout le reste seront disponible dans ce fichier
include_once '../controllers/home.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>


<body>
    <header>
        <h1>Dashboard</h1>
        <a href="./logout.php">Deconexion</a>
    </header>
    <main>
        <div class="addimg">
            <a href="./addimage.php">Ajouter une image</a>
        </div>
        <div class="container">
            <?php
            //si mon tableau d'image n'est pas vide :
            if (!empty($imgs)) {
                //je parcourt toutes mes images
                foreach ($imgs as $i => $img) {
                    //si l'image appartien bien a l'utilisateur qui est connecté, je l'affiche
                    if ($img['mail'] == $_SESSION['user']) {
            ?>
                        <div class="card">
                            <img src="<?= $img['path'] ?>">
                            <p><?= $img["name"] ?></p>
                            <a href="?rmindex=<?= $i ?>">Supprimer</a>
                        </div>
             <?php
                    }
                }
            }
            ?>
        </div>

    </main>

</body>

</html>