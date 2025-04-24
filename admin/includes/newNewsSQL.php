<?php
if (!empty($_POST['title']) AND !empty($_POST['intro']) AND !empty($_POST['year']) AND !empty($_POST['month']) AND !empty($_POST['day'])) {
$title = $_POST['title'];
$timestamp1 = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' ' . $_POST['hour'] . ':' . $_POST['minute'] . ':00';
$category = $_POST['category'];
$intro = $_POST['intro'];
$content = $_POST['content'];
$idMember = $_POST['idMember'];
    $DBC = mysql_connect("localhost", "root", "");
    mysql_select_db("creative");
    $q = "INSERT INTO news (title, timestamp1, intro, content, MEMBER_id, CATEGORY_id) VALUES ('$title', '$timestamp1', '$intro', '$content', $idMember, $category)";
    if (mysql_query($q)) {
        $message = "News bien enregistré.";
    } else {
        $message = "Une erreur s'est produite.";
    }
    mysql_close($DBC);
} else {
    $message = "Le ou les champs suivant n'ont pas été remplies : pseudo, password, email.";
}
?>