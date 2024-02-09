<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/authentification.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentaire = $_POST["commentaire"];
    $idR = $_POST["idR"];
    $note = $_POST["note"];
    $do = $_POST["do"];
    $note = intval($note);
    var_dump($note);
    //exit;

    if ($do == "ajouter") {
        addCritiquer($idR, getMailULoggedOn(), $note, $commentaire);
        header("Location: $?action=detail&idR=$idR");
        exit;
    } else if ($do == "modifier") {
        editCritiquer($idR, getMailULoggedOn(), $note, $commentaire);
        header("Location: $?action=detail&idR=$idR");
        exit;
    }
    exit;
}


