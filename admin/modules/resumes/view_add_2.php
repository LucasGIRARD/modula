<h1><?php echo $actionDisplay; ?> un cv</h1>
<a href="?module=resumes">Listing</a>
<form action="index.php?module=resumes&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>

        <div>
            <label for="adress">Adresse : </label>
            <select name="adress" id="adress">        
                <?php
                foreach ($adresss as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
        </div>

        <div>
            <label for="email">Adresse Email : </label>
            <select name="email" id="email">        
                <?php
                foreach ($emails as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
        </div>       

        <div>
            <label for="mobile">Téléphone mobile : </label>
            <select name="mobile" id="mobile">        
                <?php
                foreach ($mobiles as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
        </div>

        <div>
            <label for="landline">Téléphone fixe : </label>
            <select name="landline" id="landline">        
                <?php
                foreach ($landlines as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
        </div>
        
        </fieldset>
    
    <fieldset>
        <legend>Expériences professionnelles</legend>

        <?php
        foreach ($workExperiences as $key => $value) {
            echo '<fieldset class=\'inline\'>
        <legend>', $key, '</legend>';

            if ($value['active'] == TRUE) {
                echo '<div class=\'resumeWE\'><input type="checkbox" name=\'resumeWE[]\' value="', $key, '" checked=\'checked\' /></div>';
            } else {
                echo '<div class=\'resumeWE\'><input type="checkbox" name=\'resumeWE[]\' value="', $key, '" /></div>';
            }

            echo '<div>
            <label>Type de contrat : </label>
            <div class=\'inline\'>', $value['type'], '</div>
        </div>';
            echo '<div>
            <label>Date début : </label>
            <div class=\'inline\'>', $value['startDay'], '/', $value['startMonth'], '/', $value['startYear'], '/</div>
        </div>';
            echo '<div>
            <label>Date fin : </label>
            <div class=\'inline\'>', $value['endDay'], '/', $value['endMonth'], '/', $value['endYear'], '/</div>
        </div>';
            echo '<div>
            <label>Entreprise : </label>
            <div class=\'inline\'>', $value['company'], '</div>
        </div>';
            echo '<div>
            <label>Intitulé du poste : </label>
            <div class=\'inline\'>', $value['situation'], '</div>
        </div>';
            echo '<div>
            <label>Desciption compétence : </label>
            <div class=\'inline\'>', $value['skill'], '</div>
        </div>';
            echo '</fieldset>';
        }
        ?>

    </fieldset>

    <fieldset>
        <legend>Formations</legend>

        <?php
        foreach ($educations as $key => $value) {
            echo '<fieldset class=\'inline\'>
        <legend>', $key, '</legend>';

            if ($value['active'] == TRUE) {
                echo '<div class=\'resumeEducation\'><input type="checkbox" name=\'resumeEducation[]\' value="', $key, '" checked=\'checked\' /></div>';
            } else {
                echo '<div class=\'resumeEducation\'><input type="checkbox" name=\'resumeEducation[]\' value="', $key, '" /></div>';
            }

            echo '<div>
            <label>Date début : </label>
            <div class=\'inline\'>', $value['startDay'], '/', $value['startMonth'], '/', $value['startYear'], '/</div>
        </div>';
            echo '<div>
            <label>Date fin : </label>
            <div class=\'inline\'>', $value['endDay'], '/', $value['endMonth'], '/', $value['endYear'], '/</div>
        </div>';

            echo '<div>
            <label for="educationDegree">Diplôme : </label>
            <div class=\'inline\'>', $value['degree'], '</div>
        </div>';
            echo '<div>
            <label for="educationSpecialty">Spécialité : </label>
            <div class=\'inline\'>', $value['specialty'], '</div>
        </div>';
            echo '<div>
            <label for="educationOption">Option : </label>
            <div class=\'inline\'>', $value['option'], '</div>
        </div>';
            echo '<div>
            <label for="educationSchool">Ecole : </label>
            <div class=\'inline\'>', $value['school'], '</div>
        </div>';
            echo '<div>
            <label for="educationTown">Ville : </label>
            <div class=\'inline\'>', $value['town'], '</div>
        </div>';
            echo '</fieldset>';
        }
        ?>

    </fieldset>

    <fieldset>
        <legend>Compétences techniques</legend>

        <?php
        foreach ($skills as $key => $value) {
            echo '<fieldset class=\'inline\'>        
        <legend>', $key, '</legend>';

            if ($value['active'] == TRUE) {
                echo '<div class=\'resumeSkills\'><input type="checkbox" name=\'resumeSkills[]\' value="', $key, '" checked=\'checked\' /></div>';
            } else {
                echo '<div class=\'resumeSkills\'><input type="checkbox" name=\'resumeSkills[]\' value="', $key, '" /></div>';
            }

            echo '<div>
            <label>Catégorie : </label>
            <div class=\'inline\'>', $value['category'], '</div><br />';

            echo '<label for="activitie">Desciption :</label>
            <div class=\'inline\'>', $value['skill'], '</div></div>';

            echo '</fieldset>';
        }
        ?>  
    </fieldset>

    <fieldset>
        <legend>Centres d'intérêts</legend>

        <?php
        foreach ($activities as $key => $value) {
            echo '<fieldset class=\'inline\'>
        <legend>', $key, '</legend>';

            if ($value['active'] == TRUE) {
                echo '<div class=\'resumeActivities\'><input type="checkbox" name=\'resumeActivities[]\' value="', $key, '" checked=\'checked\' /></div>';
            } else {
                echo '<div class=\'resumeActivities\'><input type="checkbox" name=\'resumeActivities[]\' value="', $key, '" /></div>';
            }

            echo '<div>
            <label>Catégorie : </label>
            <div class=\'inline\'>', $value['category'], '</div><br />';

            echo '<label for="activitie">Desciption :</label>
            <div class=\'inline\'>', $value['activitie'], '</div></div>';

            echo '</fieldset>';
        }
        ?>  
    </fieldset>
    <input type="hidden" name="resumeWEOld" value="<?php echo $resumeWEOld; ?>" />
    <input type="hidden" name="resumeEducationOld" value="<?php echo $resumeEducationOld; ?>" />
    <input type="hidden" name="resumeSkillsOld" value="<?php echo $resumeSkillsOld; ?>" />
    <input type="hidden" name="resumeActivitiesOld" value="<?php echo $resumeActivitiesOld; ?>" />
    <input type="hidden" name="step" value="<?php echo $nextStep; ?>" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>