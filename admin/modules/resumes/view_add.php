<h1><?php echo $actionDisplay; ?> un cv</h1>
<a href="?module=resumes">Listing</a>
<form action="index.php?module=resumes&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>

        <div>
            <label for="member">Membre : </label>
            <select name="member" id="member">        
                <?php
                foreach ($members as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
        </div>


        <div><label for="name">Nom du cv :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>

        <div>
            <label for="enabled">Activé :</label>
            <select id="enabled" name="enabled">
                <option value="1">Oui</option>                
                <option value="0">Non</option>
            </select>
        </div>

        <div>
            <label for="telework">télétravail :</label>
            <select id="telework" name="telework">               
                <option value="1">Oui</option>                
                <option value="0">Non</option>
            </select>
        </div>
        
        <div><label for="annualRemunerationStart">Rémunération annuel brut début tranche :</label><input type="text" id="annualRemunerationStart" name="annualRemunerationStart" value="<?php echo $annualRemunerationStart; ?>" /></div>
        <div><label for="annualRemunerationEnd">Rémunération annuel brut fin tranche :</label><input type="text" id="annualRemunerationEnd" name="annualRemunerationEnd" value="<?php echo $annualRemunerationEnd; ?>" /></div>
    </fieldset>

    <input type="hidden" name="step" value="1" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>