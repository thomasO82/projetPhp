<?php
// j'inclu mon authguard ici, 
include_once '../utils/authGuard.php';

$pathJson = "../bdd/img.json"; // le chemin d'acces de mon fichier
$datajson = file_get_contents($pathJson);// je recuêre le contenu de mon json
$imgs = json_decode($datajson, true); // je le transforme en tableau associatif qui contiendra les infos de mes images

//si j'ai dans ma requete, une vaiable "rmindex" exemple http://localhost/pages/home?rmindex=3
if (isset($_GET["rmindex"])) {
    unset($imgs[$_GET["rmindex"]]); // je supprime dans mon tableau l'element qui correspond a l'index 'rmindex'
    $imgsJson =  json_encode($imgs, JSON_PRETTY_PRINT); // je retransforme mon tableau en json
    file_put_contents($pathJson, $imgsJson); // je l'insere dans mon fichier
}
?>