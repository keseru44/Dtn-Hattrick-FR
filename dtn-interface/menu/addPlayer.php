<?php
require_once("../includes/head.inc.php");
require("../includes/serviceEquipes.php");
require("../includes/serviceListesDiverses.php");
require("../includes/serviceJoueur.php");
require("../includes/serviceMatchs.php");
require_once "../_config/CstGlobals.php"; 
require("../includes/langue.inc.php");

// Initialisation des variables
$ordre = isset($ordre) ? $ordre : "nomJoueur";
$sens = isset($sens) ? $sens : "ASC";
$lang = isset($lang) ? $lang : "FR";

if (isset($_SESSION['listID']) && !isset($_REQUEST['listID'])) {
  $_REQUEST['listID'] = $_SESSION['listID'];
}
?>

<!--<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">-->
<table width="700" class="ContenuCentrer">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <!-- Entête tableau pour l'ajout des joueurs sur le marché des transferts -->
    <td height="20" class="EnteteContenu">
      Ajouter un ou plusieurs joueurs
    </td>
  </tr>
  <tr>
    <td> 
      <br /> 
      2 - Entrez la liste des IDs de joueurs actuellement sur le marché des transferts que vous souhaitez ajouter dans la base :<br>
      <br />
    </td>
  </tr>
  <tr>
    <td class="ContenuCentrer">
      <textarea name="listID" id="listID" style="font-size:7pt;font-family:Arial" cols=150 rows=6 <?= isset($_SESSION['listID']) ? $_SESSION['listID'] : '' ?>></textarea>
    </td>
  </tr>
  <tr>
    <td>
      <i>Remarque : Chaque ID de joueur doit être séparé par un ";"</i>
    </td>
  </tr> 
  <tr> 
    <td class="ContenuCentrer">
      <br />
      <input type="submit" name="button" value="AJOUTER" class="boutonGris" <?= !isset($_SESSION["HT"]) ? 'DISABLED' : '' ?> />
      <br />
      <br />
    </td>
  </tr>
</table>

<br />

<?php 
if (isset($_REQUEST['listID'])) {
    ?>
    <script language="JavaScript">
    document.form1.listID.value  = "<?=$_REQUEST['listID']?>";
    </script>
    <?php             
    $xml=null;
    $arrayID=null;
    $player=null;
    $listID = str_replace(CHR(32), "", $_REQUEST['listID']);
    $arrayID = explode(";", $listID);
    foreach ($arrayID as $id) {
        $joueurHT[] = getDataUnJoueurFromHT_usingPHT($id);
    }
    ?>
    <table width="700" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr> 
      <td>
        <div align="center"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="activ">
              <td colspan="4" height="20" bgcolor="#000000"> 
                <div align="center"><font color="#FFFFFF">Liste des joueurs</font></div>
              </td>
            </tr>
            <tr class="activ" bgcolor="#0000CC">
              <td width="10%" bgcolor="#0000CC"> 
                <font color="#FFFFFF">Id Joueur</font>
              </td>
              <td width="30%" bgcolor="#0000CC"> 
                <font color="#FFFFFF">Nom Joueur</font>
              </td>
              <td width="50%" bgcolor="#0000CC"> 
                <font color="#FFFFFF">Commentaire</font>
              </td>
              <td width="10%" bgcolor="#0000CC"> 
                <font color="#FFFFFF">Fiche</font>
              </td>
            </tr>
            <?php foreach ($joueurHT as $joueur) { ?>
            <tr bgcolor=<?php if ($i % 2 == 0) {?>"lightblue"<?php } else {?>"#FFFFFF"<?php }?>>
              <td width="1" bgcolor="#000000"><img src="../images/spacer.gif" width="1" height="1"></td>
              <td width="10%"> <?=$joueur['idJoueur']?></td>
              <td width="1" bgcolor="#000000"><img src="../images/spacer.gif" width="1" height="1"></td>
              <td width="30%"><?=strtr($joueur['prenomJoueur'], "'", " ")?> <?=strtr($joueur['nomJoueur'], "'", " ")?></td>
              <td width="1" bgcolor="#000000"><img src="../images/spacer.gif" width="1" height="1"></td>
              <td width="50%"><font color="<?=$FontColor?>"><?=$commentaireJ?></font></td>
              <td width="1" bgcolor="#000000"><img src="../images/spacer.gif" width="1" height="1"></td>
              <td width="10%" align="center"><?=$lien?></font></td>
              <td width="1" bgcolor="#000000"><img src="../images/spacer.gif" width="1" height="1"></td>
            </tr>
            <tr> 
              <td bgcolor="#000000"><img src="../images/spacer.gif" width="1" height="1"></td>
            </tr>
            <?php } /*Fin boucle foreach */ ?>  
          </table>
        </div>
      </td>
    </tr>
    </table>
<?php } /* Fin si : connexion ht OK*/ ?>
</body>
</html>
