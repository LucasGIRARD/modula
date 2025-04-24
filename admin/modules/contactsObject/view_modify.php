<h1><?php echo $actionDisplay; ?> un objet</h1>
<a href="?module=contactsObject">Listing</a>

<form action="index.php?module=contactsObject&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Objet :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
    </fieldset>


    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>