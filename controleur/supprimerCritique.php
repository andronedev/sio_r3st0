<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/authentification.inc.php";


$idR = $_GET["idR"];
$mailU = getMailULoggedOn();

deleteCritiquer($idR, $mailU);
header("Location: ?action=detail&idR=$idR");
exit;



