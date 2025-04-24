<?php
if (!isset($_SESSION['pseudo'])) {
    if (empty($_POST['page'])){
        $page = "news";
    }
    else{
        $page = $_POST['page'];
    }
    ?>
<div id="connect">
    <form action="?page=work" method="post">
        <fieldset>
            <div>
                <br />
                <label for="pseudo">pseudo :</label><input type="text" size="45" maxlength="30" name="pseudo" id="pseudo" value="" /><br />
                <label for="pass">Password :</label><input type="password" size="60" maxlength="50" name="pass" id="pass" value="" /><br />
                <input type="hidden" name="action" value="connect" />
                <input type='hidden' name='page' value='<?php echo $page; ?>' />
            </div>
        </fieldset>
        <input type="submit" value="Envoyer" />
    </form>
</div>
    <?php
}
?>