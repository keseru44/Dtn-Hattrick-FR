<?php
session_start();

// Inclusions des fichiers
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/connect.inc.php");
//require_once("http://localhost/dtn-interface/dtn/includes/connect.inc.php");

// Initialisation des variables d'environnement
$cheminComplet = $_SERVER["DOCUMENT_ROOT"] . "/dtn/";
$url = $_SERVER["DTNHTFFF_PROTOCOL"] . "://" . $_SERVER["HTTP_HOST"] . "/dtn/interface";
$db_c = $_SERVER["DTNHTFFF_DATABASE"];

// Variables de session
$_SESSION['cheminComplet'] = $cheminComplet;
$_SESSION['url'] = $url;

// Contrôle d'authentification
if (!isset($_SESSION['sesUser']) && !in_array(basename($_SERVER['PHP_SELF']), array('index.php', 'index2.php'))) {
    echo "Accès interdit - Aucune session ouverte";
    echo "<a href=\"$url\"> Cliquez ici pour vous authentifier </a>";
    exit;
}

?>
