<h1><?php echo $actionDisplay; ?> un cv</h1>
<a href="?module=resumes">Listing</a>
<form action="index.php?module=resumes&action=<?php echo $action; ?>" method="POST">

    <fieldset>
        <legend>Général</legend>

        <div>
            <label for="member">Membre : </label>
            <select name="member" id="member">        
                <?php
                if ($member == '') {
                    echo '<option value="" selected="selected">Aucun</option>';
                } else {
                    echo '<option value="">Aucun</option>';
                }

                foreach ($members as $key => $value) {
                    if ($member == $key) {
                        echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                    } else {
                        echo '<option value="', $key, '">', $value, '</option>';
                    }
                }
                ?>       
            </select>
        </div>


        <div><label for="name">Nom du cv :</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>

        <div>
            <label for="enabled">Activé :</label>
            <select id="enabled" name="enabled">
                <?php
                if ($enabled == 0) {
                    echo '<option value="1">Oui</option>                
                <option value="0" selected="selected">Non</option>';
                } elseif ($enabled == 1) {
                    echo '<option value="1" selected="selected">Oui</option>                
                <option value="0">Non</option>';
                } else {
                    echo '<option value="1">Oui</option>                
                <option value="0">Non</option>';
                }
                ?>                      
            </select>
        </div>

        <div>
            <label for="telework">télétravail :</label>
            <select id="telework" name="telework">
                <?php
                if ($telework == 0) {
                    echo '<option value="1">Oui</option>                
                <option value="0" selected="selected">Non</option>';
                } elseif ($telework == 1) {
                    echo '<option value="1" selected="selected">Oui</option>                
                <option value="0">Non</option>';
                } else {
                    echo '<option value="1">Oui</option>                
                <option value="0">Non</option>';
                }
                ?>                      
            </select>
        </div>

        <div>
            <label for="adress">Adresse : </label>
            <select name="adress" id="adress">        
                <?php
                if ($adress == '') {
                    echo '<option value="" selected="selected">Aucune</option>';
                } else {
                    echo '<option value="">Aucune</option>';
                }

                foreach ($adresss as $key => $value) {
                    if ($adress == $key) {
                        echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                    } else {
                        echo '<option value="', $key, '">', $value, '</option>';
                    }
                }
                ?>       
            </select>
        </div>

        <div>
            <label for="email">Adresse Email : </label>
            <select name="email" id="email">        
                <?php
                if ($email == '') {
                    echo '<option value="" selected="selected">Aucune</option>';
                } else {
                    echo '<option value="">Aucune</option>';
                }

                foreach ($emails as $key => $value) {
                    if ($email == $key) {
                        echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                    } else {
                        echo '<option value="', $key, '">', $value, '</option>';
                    }
                }
                ?>       
            </select>
        </div>       

        <div>
            <label for="mobile">Téléphone mobile : </label>
            <select name="mobile" id="mobile">        
                <?php
                if ($mobile == "") {
                    echo '<option value="" selected="selected">Aucun</option>';
                } else {
                    echo '<option value="">Aucun</option>';
                }

                foreach ($mobiles as $key => $value) {
                    if ($mobile == $key) {
                        echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                    } else {
                        echo '<option value="', $key, '">', $value, '</option>';
                    }
                }
                ?>       
            </select>
        </div>

        <div>
            <label for="landline">Téléphone fixe : </label>
            <select name="landline" id="landline">        
                <?php
                if ($landline == "") {
                    echo '<option value="" selected="selected">Aucun</option>';
                } else {
                    echo '<option value="">Aucun</option>';
                }

                foreach ($landlines as $key => $value) {
                    if ($landline == $key) {
                        echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                    } else {
                        echo '<option value="', $key, '">', $value, '</option>';
                    }
                }
                ?>       
            </select>
        </div>

        <div><label for="annualRemunerationStart">Rémunération annuel brut début tranche :</label><input type="text" id="annualRemunerationStart" name="annualRemunerationStart" value="<?php echo $annualRemunerationStart; ?>" /></div>
        <div><label for="annualRemunerationEnd">Rémunération annuel brut fin tranche :</label><input type="text" id="annualRemunerationEnd" name="annualRemunerationEnd" value="<?php echo $annualRemunerationEnd; ?>" /></div>
    </fieldset>


    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="submit" value="<?php echo $actionDisplay; ?>" />
</form>

<fieldset>
    <legend>Expériences professionnelles</legend>
    <fieldset>
        <legend>Nouvelle</legend>

        <div>
            <label for="workExperienceType">Type de contrat : </label>
            <select name="workExperienceType" id="workExperienceType">        
                <?php
                foreach ($workExperienceTypes as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
        </div>

        <div>
            <label for="workExperienceStartDay">Date début : </label>
            <input type="text" name="workExperienceStartDay" id="workExperienceStartDay" size="1" maxlength="2" value="" /> / <input type="text" name="workExperienceStartMonth" size="1" maxlength="2" value="" /> / <input type="text" name="workExperienceStartYear" size="2" maxlength="4" value="" />
        </div>
        <div>
            <label for="workExperienceEndDay">Date fin : </label>
            <input type="text" name="workExperienceEndDay" id="workExperienceEndDay" size="1" maxlength="2" value="" /> / <input type="text" name="workExperienceEndMonth" size="1" maxlength="2" value="" /> / <input type="text" name="workExperienceEndYear" size="2" maxlength="4" value="" />
        </div>

        <div>
            <label for="workExperienceCompany">Entreprise : </label>
            <input type="text" id="workExperienceCompany" name="workExperienceCompany" value="" />
        </div>

        <div>
            <label for="workExperienceSituation">Intitulé du poste : </label>
            <input type="text" id="workExperienceSituation" name="workExperienceSituation" value="" />
        </div>

        <div>
            <label for="workExperienceSkill">Desciption compétence : </label>
            <input type="text" id="workExperienceSkill" name="workExperienceSkill" value="" />
        </div>

    </fieldset>
    <?php
    foreach ($workExperiences as $key => $value) {
        echo '<fieldset>
        <legend>', $key, '</legend>';

        echo '<div>
            <label for="workExperienceType">Type de contrat : </label>
            <select name="workExperienceType" id="workExperienceType">';

        foreach ($workExperienceTypes as $key2 => $value2) {
            if ($value['type'] == $key2) {
                echo '<option value="', $key2, '" selected="selected">', $value2, '</option>';
            } else {
                echo '<option value="', $key2, '">', $value2, '</option>';
            }
        }


        echo '</select>
        </div>';
        echo '<div>
            <label for="workExperienceStartDay">Date début : </label>
            <input type="text" name="workExperienceStartDay" id="workExperienceStartDay" size="1" maxlength="2" value="', $value['startDay'], '" /> / <input type="text" name="workExperienceStartMonth" size="1" maxlength="2" value="', $value['startMonth'], '" /> / <input type="text" name="workExperienceStartYear" size="2" maxlength="4" value="', $value['startYear'], '" />
        </div>';
        echo '<div>
            <label for="workExperienceEndDay">Date fin : </label>
            <input type="text" name="workExperienceEndDay" id="workExperienceEndDay" size="1" maxlength="2" value="', $value['endDay'], '" /> / <input type="text" name="workExperienceEndMonth" size="1" maxlength="2" value="', $value['endMonth'], '" /> / <input type="text" name="workExperienceEndYear" size="2" maxlength="4" value="', $value['endYear'], '" />
        </div>';
        echo '<div>
            <label for="workExperienceCompany">Entreprise : </label>
            <input type="text" id="workExperienceCompany" name="workExperienceCompany" value="', $value['company'], '" />
        </div>';
        echo '<div>
            <label for="workExperienceSituation">Intitulé du poste : </label>
            <input type="text" id="workExperienceSituation" name="workExperienceSituation" value="', $value['situation'], '" />
        </div>';
        echo '<div>
            <label for="workExperienceSkill">Desciption compétence : </label>
            <input type="text" id="workExperienceSkill" name="workExperienceSkill" value="', $value['skill'], '" />
        </div>';
        echo '</fieldset>';
    }
    ?>

</fieldset>

<fieldset>
    <legend>Formations</legend>
    <fieldset>
        <legend>Nouvelle</legend>
        <div>
            <label for="educationStartDay">Date début : </label>
            <input type="text" name="educationStartDay" id="educationStartDay" size="1" maxlength="2" value="" /> / <input type="text" name="educationStartMonth" size="1" maxlength="2" value="" /> / <input type="text" name="educationStartYear" size="2" maxlength="4" value="" />
        </div>
        <div>
            <label for="educationEndDay">Date fin : </label>
            <input type="text" name="educationEndDay" id="educationEndDay" size="1" maxlength="2" value="" /> / <input type="text" name="educationEndMonth" size="1" maxlength="2" value="" /> / <input type="text" name="educationEndYear" size="2" maxlength="4" value="" />
        </div>

        <div>
            <label for="educationDegree">Diplôme : </label>
            <input type="text" id="educationDegree" name="educationDegree" value="" />
        </div>

        <div>
            <label for="educationSpecialty">Spécialité : </label>
            <input type="text" id="educationSpecialty" name="educationSpecialty" value="" />
        </div>

        <div>
            <label for="educationOption">Option : </label>
            <input type="text" id="educationOption" name="educationOption" value="" />
        </div>    

        <div>
            <label for="educationSchool">Ecole : </label>
            <input type="text" id="educationSchool" name="educationSchool" value="" />
        </div>

        <div>
            <label for="educationTown">Ville : </label>
            <input type="text" id="educationTown" name="educationTown" value="" />
        </div>
    </fieldset>

    <?php
    foreach ($educations as $key => $value) {
        echo '<fieldset>
        <legend>', $key, '</legend>';

        echo '<div>
            <label for="educationStartDay">Date début : </label>
            <input type="text" name="educationStartDay" id="educationStartDay" size="1" maxlength="2" value="', $value['startDay'], '" /> / <input type="text" name="educationStartMonth" size="1" maxlength="2" value="', $value['startMonth'], '" /> / <input type="text" name="educationStartYear" size="2" maxlength="4" value="', $value['startYear'], '" />
        </div>';
        echo '<div>
            <label for="educationEndDay">Date fin : </label>
            <input type="text" name="educationEndDay" id="educationEndDay" size="1" maxlength="2" value="', $value['endDay'], '" /> / <input type="text" name="educationEndMonth" size="1" maxlength="2" value="', $value['endMonth'], '" /> / <input type="text" name="educationEndYear" size="2" maxlength="4" value="', $value['endYear'], '" />
        </div>';
        echo '<div>
            <label for="educationDegree">Diplôme : </label>
            <input type="text" id="educationDegree" name="educationDegree" value="', $value['degree'], '" />
        </div>';
        echo '<div>
            <label for="educationSpecialty">Spécialité : </label>
            <input type="text" id="educationSpecialty" name="educationSpecialty" value="', $value['specialty'], '" />
        </div>';
        echo '<div>
            <label for="educationOption">Option : </label>
            <input type="text" id="educationOption" name="educationOption" value="', $value['option'], '" />
        </div>';
        echo '<div>
            <label for="educationSchool">Ecole : </label>
            <input type="text" id="educationSchool" name="educationSchool" value="', $value['school'], '" />
        </div>';
        echo '<div>
            <label for="educationTown">Ville : </label>
            <input type="text" id="educationTown" name="educationTown" value="', $value['town'], '" />
        </div>';
        echo '</fieldset>';
    }
    ?>

</fieldset>

<fieldset>
    <legend>Compétences techniques</legend>
    <fieldset>
        <legend>Nouvelle</legend>
        <div><label for="skillCategory">Catégorie :</label><input type="text" id="skillCategory" name="skillCategory" value="" /></div>

        <div>
            <label for="skillCategory">Catégorie : </label>
            <select name="skillCategory" id="skillCategory">        
                <?php
                foreach ($skillCategories as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
            <label for="skill">Compétence :</label><input type="text" id="skill" name="skill" value="" /></div>
    </fieldset>

    <?php
    foreach ($skills as $key => $value) {
        echo '<fieldset>
        <legend>', $key, '</legend>';

        echo '<div>
            <label for="skillCategory">Catégorie : </label>
            <select name="skillCategory" id="skillCategory">';

        foreach ($skillCategories as $key2 => $value2) {
            if ($value['category'] == $key2) {
                echo '<option value="', $key2, '" selected="selected">', $value2, '</option>';
            } else {
                echo '<option value="', $key2, '">', $value2, '</option>';
            }
        }

        echo '</select>';

        echo '<label for="skill">Compétence :</label><input type="text" id="skill" name="skill" value="', $value['skill'], '" /></div>';

        echo '</fieldset>';
    }
    ?>   

</fieldset>

<fieldset>
    <legend>Centres d'intérêts</legend>
    <fieldset>
        <legend>Nouvelle</legend>
        <div><label for="activitieCategory">Catégorie :</label><input type="text" id="activitieCategory" name="activitieCategory" value="" /></div>

        <div>
            <label for="activitieCategory">Catégorie : </label>
            <select name="activitieCategory" id="activitieCategory">        
                <?php
                foreach ($activitieCategories as $key => $value) {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
                ?>       
            </select>
            <label for="activitie">Desciption :</label><input type="text" id="activitie" name="activitie" value="" /></div>
    </fieldset>

    <?php
    foreach ($activities as $key => $value) {
        echo '<fieldset>
        <legend>', $key, '</legend>';

        echo '<div>
            <label for="activitieCategory">Catégorie : </label>
            <select name="activitieCategory" id="activitieCategory">';
        
        foreach ($activitieCategories as $key2 => $value2) {
            if ($value['category'] == $key2) {
                echo '<option value="', $key2, '" selected="selected">', $value2, '</option>';
            } else {
                echo '<option value="', $key2, '">', $value2, '</option>';
            }
        }

        echo '</select>';

        echo '<label for="activitie">Desciption :</label><input type="text" id="activitie" name="activitie" value="', $value['activitie'], '" /></div>';

        echo '</fieldset>';
    }
    ?>  
</fieldset>