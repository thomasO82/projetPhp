<?php
    session_start();
    $userpath = '../bdd/user.json'; //le chemin d'acces de mon json
    $userjson = file_get_contents($userpath); //je recupere le contenu du fichier json
    $userArr = json_decode($userjson, true); //je le transforme en tablea associatif
    $findedUser = null; // cette variable me permettra de savoir si j'ai trouver un utilisateur qui correspond ou non
    //je parcours mon tableau
    foreach ($userArr as $user) {
        // si je trouve bien un utilisateur qui a le meme mail que dans ma session, je set findedUser a true
        if ($user['mail'] == $_SESSION['user']['mail']) {
            $findedUser = true;
            break;
        }
    }
    // si un user n'a pas ete trouver, je redirige vers la page login.
    if (!$findedUser ) {
       header('Location: ./login.php');
    }

?>