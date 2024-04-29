<?php 
require_once("./includes/head.inc.php");

// Vérifiez si l'utilisateur est connecté
if(!$sesUser["idAdmin"]) {
	header("location: index.php?ErrorMsg=Session Expiree");
	exit; // Arrête l'exécution du script pour éviter tout traitement inutile
}

// Tableau associatif entre les identifiants de niveau d'accès et les fichiers à inclure
$menuFiles = [
    "1" => ["menu/menuAdmin.php", "menu/menuAdminDesc.php"],
    "2" => ["menu/menuSuperviseur.php", "menu/menuSuperviseurDesc.php"],
    "3" => ["menu/menuDTN.php", "menu/menuDTNDesc.php"],
    "4" => ["menu/menuCoach.php", "menu/menuCoachDesc.php"]
];

// Inclure les fichiers correspondants au niveau d'accès de l'utilisateur
if(isset($menuFiles[$sesUser["idNiveauAcces"]])) {
    foreach ($menuFiles[$sesUser["idNiveauAcces"]] as $file) {
        require($file);
    }
    require("outils/monTableauBord.php");
} else {
    // Si le niveau d'accès n'est pas reconnu, afficher un message d'erreur
    $Msg = "Niveau d'accès non valide.";
}

// Afficher le message s'il est défini
if(isset($Msg)){
?>
    <font size=+2 color=red><?=$Msg?></font>
<?php } ?>
