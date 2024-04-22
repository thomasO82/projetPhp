<?php
// Inclusion du fichier d'authentification
include_once '../utils/authGuard.php';

// Initialisation du tableau des erreurs
$errors = [];

// Vérification si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si le champ 'name' est vide
    if (empty($_POST['name'])) {
        $errors['name'] = "le nom de l'image est requis";
    }

    // Vérification si aucun fichier n'a été téléchargé ou s'il y a une erreur de téléchargement
    if (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
        $errors['img'] = "Pas d'image";
    }

    // Si aucune erreur détectée
    if (empty($errors)) {
        // Récupération des informations sur le fichier téléchargé
        $fileTmpPath = $_FILES['img']['tmp_name'];
        $fileName = $_FILES['img']['name'];
        $fileType = $_FILES['img']['type'];

        // Types de fichiers autorisés
        $allowedTypes = array(
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/svg+xml',
        );

        // Vérification si le type de fichier téléchargé est autorisé
        if (!in_array($fileType, $allowedTypes)) {
            $errors['img'] = "Erreur : Seuls les fichiers JPEG, PNG, WEBP, SVG et GIF sont autorisés.";
        } else {
            // Déplacement du fichier téléchargé vers le dossier de destination
            $destination = '../assets/img/'.$fileName;
            if (move_uploaded_file($fileTmpPath, $destination)) {
                // Création des informations sur le fichier pour enregistrement dans le JSON
                $fileInfo = array(
                    "name" => $_POST['name'],
                    "path" => $destination,
                    "mail" => $_SESSION['user'],
                );

                // Récupération des données JSON existantes
                $jsonData = file_get_contents("../bdd/img.json");
                $data = json_decode($jsonData, true);

                // Ajout des nouvelles informations sur le fichier
                $data[] = $fileInfo;

                // Conversion des données en JSON et enregistrement dans le fichier
                $newJsonData = json_encode($data, JSON_PRETTY_PRINT);
                file_put_contents("../bdd/img.json", $newJsonData);

                // Redirection vers la page d'accueil après le téléchargement réussi
                header('Location: ./home.php');
            } else {
                $errors['img'] = "Erreur lors du téléchargement du fichier.";
            }
        }
    }
}
?>
