<h1><?php echo $actionDisplay; ?> un thèmes</h1>
<a href="?module=themes">Listing</a>

<form action="index.php?module=themes&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>
        <div><label for="name">Nom du thèmes :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
        <div><label for="alias">Alias du thèmes :</label><input type="text" id="alias" name="alias" value="<?php echo $alias; ?>" /></div>         
    </fieldset>

    <fieldset>
        <legend><label for="content">Contenu</label></legend>
        
        <fieldset>
            <legend><label for="html">HTML</label></legend>
            <textarea id="html" name="html" rows="4" cols="20"><?php echo $html; ?></textarea>
        </fieldset>
        <fieldset>
            <legend><label for="javascript">JavaScript</label></legend>
            <textarea id="javascript" name="javascript" rows="4" cols="20"><?php echo $javascript; ?></textarea>
        </fieldset>
        <fieldset>
            <legend><label for="css">CSS</label></legend>
            <textarea id="css" name="css" rows="4" cols="20"><?php echo $css; ?></textarea>
        </fieldset>
    </fieldset>    

    <fieldset>
        <legend><label for="content">Fichier</label></legend>
        <fieldset>
            <legend><label for="content">JavaScript</label></legend>
            
        </fieldset>
        <fieldset>
            <legend><label for="content">CSS</label></legend>
            
        </fieldset>        
    </fieldset>  


    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />

</form>