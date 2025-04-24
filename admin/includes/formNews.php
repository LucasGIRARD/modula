<?php
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT * FROM category");
mysql_close($DBC);

// Include the CKEditor class.
include_once 'ckeditor/ckeditor.php';
include_once 'ckfinder/ckfinder.php';
// Create a class instance.
$CKEditor = new CKEditor();
// Path to the CKEditor directory.
$CKEditor->basePath = 'ckeditor/';
$CKEditor->config['language'] = 'fr';

$CKFinder = new CKFinder();
$CKFinder->BasePath = 'ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
$CKFinder->SetupCKEditorObject($CKEditor);

$CKEditor->config['contentsCss'] = '../styles/style.css';
$CKEditor->config['bodyClass'] = 'bodynews';
$CKEditor->config['extraPlugins'] = 'charcount';
$CKEditor->config['charcount_limit'] = '65535';
?>
<form action="?page=<?php echo $action; ?>NewsSQL" method="post">
    <label for="title">Titre : </label><input type="text" size="60" maxlength="40" name="title" id="title" value="<?php echo $title; ?>" /><br />
    <label for="date">Date de création : </label><input type='text' name='day' id="date" size='1' maxlength='2' value=<?php echo $day; ?> /> / <input type='text' name='month' size='1' maxlength='2' value=<?php echo $month; ?> /> / <input type='text' name='year' size='2' maxlength='4' value=<?php echo $year; ?> /> à <input type='text' name='hour' size='1' maxlength='2' value=<?php echo $hour; ?> /> H <input type='text' name='minute' size='1' maxlength='2' value=<?php echo $minute; ?> /><br />
    <label for="category">Catégorie : </label><select name="category" id="category">
        <option value='' ></option>
        <?php
        while ($donnees = mysql_fetch_array($donneesSQL)) {
            if ($donnees['id'] == $category) {
                echo "<option value='" . $donnees['id'] . "' selected='selected'>" . $donnees['name'] . "</option>";
            } else {
                echo "<option value='" . $donnees['id'] . "' >" . $donnees['name'] . "</option>";
            }
        }
        ?>
    </select><br />
    <label for="intro">Intro : </label><textarea name="intro" id="intro" maxlength='65535'>
        <?php echo $intro; ?>
    </textarea>
    <label for="content">Contenu :</label><textarea name="content" id="content" maxlength='16777215'>
        <?php echo $content; ?>
    </textarea><br />
    <input type="hidden" name="idMember" value="<?php echo $idMember; ?>" />
    <input type="hidden" name="idNews" value="<?php echo $idNews; ?>" />
    <input type="submit" value="Envoyer" />
</form>
<?php
// Replace all textarea elements with CKEditor.
$CKEditor->replaceAll();
?>