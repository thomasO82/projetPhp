<?php
$errors = []; // je creer un tableau qui contiendra toutes mes erreurs, pour que je puisse les afficher au besoin
$jsonFile = "../bdd/user.json"; // le chemin d'acces de mon json qui me sert de base de donné d'utilisateur

//Si ma requette est de methode post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // je vais checker chaque champs, si ils n' existent pas, et si ils ne correspondent
    //  pas a la regex, je creer une erreur dans le tableau 
    if (!isset($_POST["name"]) || !Preg_match('/^[a-zA-ZÀ-ÿ\-]+(?:\s[a-zA-ZÀ-ÿ\-]+)*$/', $_POST["name"])) {
        $errors["name"] = "nom non valide";
    }
    if (!isset($_POST["firstname"]) || !Preg_match('/^[a-zA-ZÀ-ÿ\-]+$/', $_POST["firstname"])) {
        $errors["firstname"] = "prenom non valide";
    }
    if (!isset($_POST["mail"]) || !Preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["mail"])) {

        $errors["mail"] = "mail non valide";
    }
    if (!isset($_POST["password"]) || !Preg_match('/^(?=.*[0-9].*[0-9])(?=.*[!@#$%^&*(),.?":{}|<>]).{4,}$/', $_POST["password"])) {
        $errors["password"] = "mot de passe non valide";
    }

    // Si mon tableau d'erreur est vide :
    if (empty($errors)) {
        $jsonData = file_get_contents($jsonFile);  // recupere le json de mes users
        $users = json_decode($jsonData, true); // je decode le json en tableau associatif lisible par php
        // je creer mon user
        $newUser = array(
            'name' => $_POST['name'],
            'firstname' => $_POST['firstname'],
            'mail' => $_POST['mail'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        );
        $users[] = $newUser; // je push l'utilisateur dans le tableau qui contiens mon fichier
        $jsonUpDated = json_encode($users, JSON_PRETTY_PRINT); // j'encode mon tableau en json
        file_put_contents($jsonFile, $jsonUpDated); //j'ecrit mon nouveau tableau dans mon fichier
        header("Location: ./login.php "); // je redirige vers login
    }

    
}
?>