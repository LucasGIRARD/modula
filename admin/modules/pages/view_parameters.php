<h1>Paramètres des pages</h1>
<a href='?module=pages'>Listing</a>

<form name='index.php?module=pages&action=added' method='POST'>

    <fieldset>
        <legend>Pages</legend>
        <div>
            <label for='homePage'>Home :</label>
            <select name=''>
                <?php
                if ($homePage == "") {
                        echo '<option value="" selected="selected">Aucune</option>';
                    } else {
                        echo '<option value="">Aucun</option>';
                    }
                
                foreach ($pages as $key => $value) {
                    if ($homePage == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }                    
                }
                ?>
            </select>
        </div>
        <div>
            <label for='maintenancePage'>Maintenance :</label>
            <select name=''>
                 <?php
                if ($maintenancePage == "") {
                        echo '<option value="" selected="selected">Aucune</option>';
                    } else {
                        echo '<option value="">Aucun</option>';
                    }
                
                foreach ($pages as $key => $value) {
                    if ($maintenancePage == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }                    
                }
                ?>
            </select>
        </div>
        <div>
            <label for='403Page'>403 :</label>
            <select name=''>
                 <?php
                if ($_403Page == "") {
                        echo '<option value="" selected="selected">Aucune</option>';
                    } else {
                        echo '<option value="">Aucun</option>';
                    }
                
                foreach ($pages as $key => $value) {
                    if ($_403Page == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }                    
                }
                ?>
            </select>
        </div>
        <div>
            <label for='404Page'>404 :</label>
            <select name=''>
                 <?php
                if ($_404Page == "") {
                        echo '<option value="" selected="selected">Aucune</option>';
                    } else {
                        echo '<option value="">Aucun</option>';
                    }
                
                foreach ($pages as $key => $value) {
                    if ($_404Page == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }                    
                }
                ?>
            </select>
        </div>
    </fieldset>
</form>

