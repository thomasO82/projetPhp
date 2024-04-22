<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
// j'inclus mon controller addimage
include_once '../controllers/addimages.php'; 
?>

<body>

    <!--  N'oubliez pas le enctype="multipart/form-data" qui permet de gerer l'upload des media  -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <?php
            // Affichage d'un message d'erreur si le champ 'name' est vide

            echo isset($errors['name']) ? "<p>" . $errors['name'] . "</p>" : '';
            ?>
            <label for="name">nom :</label>
            <input type="text" id="name" name="name" value='<?php echo !empty($_POST['name']) ? $_POST['name'] : ''; ?>'>
        </div>
        <div>
            <?php
            echo isset($errors['img']) ? "<p>" . $errors['img'] . "</p>" : '';
            ?>
            <label for="img">rajouter votre image :</label>
            <input type="file" id="img" name="img">
        </div>
        <button type="submit">Valider</button>
    </form>


</body>

</html>