<?php
if (!is_numeric($_GET['id'])) {
    header("HTTP/1.0 404 Not Found");
    header("Location: index.php");
}
$idContact = $_GET['id'];
$objectArray = array("Ban par erreur", "Demande de match", "Bug site", "Bug serveur", "Autres");
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
mysql_query("UPDATE contact SET wasRead=wasRead+1 WHERE id=$idContact");
$donneesSQL = mysql_query("SELECT object, message, MEMBER_id, DATE_FORMAT(c.timestamp1,'%d/%m/%Y %H:%i')AS date1, nick FROM contact AS c LEFT JOIN member AS m ON ( c.MEMBER_id = m.id ) WHERE c.id =$idContact");
$donnees = mysql_fetch_array($donneesSQL);
mysql_close($DBC);
?>   
Auteur : <?php echo $donnees['nick']; ?><br />
Objet : <?php echo $objectArray[$donnees['object']]; ?><br />
Date : <?php echo $donnees['date1']; ?><br />
Message : <?php echo $donnees['message']; ?>


<form action="?page=answerContactSQL" method="post">    
    <p>
        Contenu :<br />

        <textarea name="contenu">
#########CITATION#########
<?php echo $donnees['message']; ?>

#########FIN DE CITATION#########
        </textarea>
    </p>
    <input type="hidden" name="idMember" value="<?php echo $donnees['MEMBER_id']; ?>" />
    <input type="hidden" name="idContact" value="<?php echo $idContact; ?>" />
    <input type="submit" value="Envoyer" />
</form>