<?php
session_start();
$_SESSION['HT'] = null;

include_once("./includes/head.inc.php");

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header('Location: index.php');
    exit;
}

function gérerConnexion($conn)
{
    if (empty($_POST['login']) || empty($_POST['password'])) {
        return "Vous devez remplir tous les champs !";
    }

    $login = $_POST['login'];
    $password = sha1($_POST['password']);

    // Définir d'autres variables de table si nécessaire

    $sql = "SELECT a.*, na.*
            FROM ht_admin a
            INNER JOIN ht_niveauacces na ON a.idNiveauAcces_fk = na.idNiveauAcces
            WHERE a.loginAdmin = ? AND a.passAdmin = ? AND a.affAdmin = 1";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$login, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return "Le nom d'utilisateur et/ou le mot de passe saisis sont incorrects.";
    }

    $_SESSION['sesUser'] = $user;

    // Récupérer des informations supplémentaires sur l'utilisateur
    $clubSql = "SELECT c.idClubHT, c.nomClub, c.nomUser
                FROM ht_clubs c
                WHERE c.idUserHT = ?";
    $clubStmt = $conn->prepare($clubSql);
    $clubStmt->execute([$user['idAdminHT']]);
    $_SESSION['sesUser']['club'] = $clubStmt->fetch(PDO::FETCH_ASSOC);

    // Mettre à jour la date et l'heure de la dernière connexion
    $updateSql = "UPDATE ht_admin
                  SET dateAvantDerniereConnexion = dateDerniereConnexion, heureAvantDerniereConnexion = heureDerniereConnexion,
                      dateDerniereConnexion = ?, heureDerniereConnexion = ?
                  WHERE idAdmin = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->execute([date("Y-m-d"), date("H:i:s"), $user['idAdmin']]);

    return true;
}

if (isset($_POST['nomForm']) && $_POST['nomForm'] == 'formConnexion') {
    //require_once("votre_fichier_de_connexion_à_la_base_de_données.php");
    $errorMessage = gérerConnexion($conn);
    if ($errorMessage === true) {
        //header("location: index2.php");
		header("location: menu/menuDTNDesc.php");
        exit;
    } else {
        $errorAuthentification = $errorMessage;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>DTN - Interface d'administration</title>
    <link href="CSS/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<br/>
<br/>
<form name="form" method="post" action="">
    <table class="ContenuCentrer">
        <tr>
            <td>
                <tr>
                    <td width="700" height="26">
                        <div align="center"> DTN - <i>Interface d'administration</i><br/> Identifiez-vous
                        </div>
                        <hr/>
                        <br/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table width="50%" class="ContenuCentrer">
                            <tr>
                                <td width="51%">Nom d'utilisateur</td>
                                <td width="49%">
                                    <input name="login" type="text" id="login" value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Mot de passe</td>
                                <td>
                                    <input name="password" type="password" id="password">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="MsgErreur">
                        <?php
                        if (isset($errorAuthentification)) echo htmlspecialchars($errorAuthentification) . "<br />";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="ContenuCentrer">
                        <input type="submit" name="Submit" value="SE CONNECTER" class="boutonGris">
                        <input name="nomForm" type="hidden" id="nomForm" value="formConnexion">
                        <br/>
                        <br/>
                    </td>
                </tr>
            </td>
        </tr>
    </table>
</form>

<font size="-1">
    <p>En cas de problème ou demande : <a href="https://github.com/hattrick-french-dtn/dtn-interface/issues">Utilisez
            Github</a></p>
</font>
</body>
</html>
