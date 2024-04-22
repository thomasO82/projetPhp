<?php
// je start une session, car je vais utiliser ma variable 
//  de session pour stoquer l'utilisateur si il s'est bien connecter
session_start();
$errors = []; // je creer un tableau qui contiendra toutes mes erreurs, pour que je puisse les afficher au besoin
$jsonFile = "../bdd/user.json";  // le chemin d'acces de mon json qui me sert de base de donné d'utilisateur

// Si ma requete est de methode post :
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // je verifie si l'utilisateur a bien entrer le mail
    if (isset($_POST['mail'])) {
        // ici, je vais checker si le mail entre par l'utilisateur existe bien en base de donnée :

        $jsonData = file_get_contents($jsonFile); // je recupere mon fichier
        $users = json_decode($jsonData, true); // je le transforme en tableau associatif
        $foundUser = []; // je declare un variable qui contiendra l'utilisateur de ma base de donné qui correspond au mail que l'utilisateur a entrer

        // je parcours le tableau de users
        foreach ($users as $user) {
            // si l'utilisateur de mon fichier correspond au mail de l'user :
            if ($user['mail'] == $_POST['mail']) {
                $foundUser = $user; // je stoque l'utilisateur dans foundUser
                break; // j'arrete la boucle, ca ne sert plus a rien de continuer vu qu'on a deja l'utilisateur
            }
        }
        // si on n'a pas trouver d'user correspondant :
        if (empty($foundUser)) {
            $errors['mail'] = "aucun utilisateur trouver"; // je creer une erreur 
        } else {
            // sinon, je verifie si les mot de passe correspond, n'oubliez pas, il est hasher, 
            // il faut donc utiliser une methode pour le verifier

            //si les mot de passe correspondent :
            if (password_verify($_POST['password'], $foundUser['password'])) {
                $_SESSION['user'] = $foundUser; // je creer une variable de session qui contiend mon user
                header('Location: ./home.php'); // je redirige vers le dashboard
                exit; // pas la peine de continuer, donc je ferme le script
            } else {
                $errors['password'] = "mauvais mot de passe"; // je push dans le tableau errors une erruer comme quoi le mot de passe est mauvais
            }
        }
    } else {
        $errors['mail'] = "entre un mail"; // je push une erreur comme quoi il faut entrer un mail
    }
}
