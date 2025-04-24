<fieldset>
    <?php
    if ($page == "fullCivilState") {
        ?>
        <div class="leftColumn">
            <span>Nom</span> : <?php echo $lastName ?><br />
            <span>Prénom</span> : <?php echo $firstName ?><br />
            <span>Âge</span> : <?php echo $age ?><br />
            <span>Situation</span> : <?php echo $maritalStatus ?><br />
            <br />
            <span>Adresse</span> : <?php echo $adress ?><br />
            <span>Ville</span> : <?php echo $town ?><br />
            <span>Code postal</span> : <?php echo $cp ?> <span>Pays</span> : <?php echo $country ?><br />
            <span>Telephone Fixe</span> : <?php echo $landlinePhone ?><br />
            <span>Telephone Mobile</span> : <?php echo $mobilePhone ?><br />
            <span>Email</span> : <?php echo $email ?><br />
            <br />
            <span>Niveau d'Etude</span> : <?php echo $studiesLevel ?><br />
            <!--<span>Télétravail</span> : <?php echo $telework ?><br />
            <span>Rémunération</span> : <?php echo $remuneration ?><br />-->
            <span>Permis de conduire</span> : <?php echo $drivingLicense ?><br />
            <span>Véhicule</span> : <?php echo $vehicle ?><br />
        </div><div class="rightColumn"><img src="image/cv/moi.jpg" alt="photo lucas girard" /></div>
        <div class="readMore"><a href="index.php?module=cv&amp;page=civilState">Réduire</a></div>
        <?php
    } else {
        ?>
        <div class="leftColumn">
            <?php echo $firstName ?> <?php echo $lastName ?><br />
            <?php echo $age ?>, <?php echo $maritalStatus ?><br />
            <?php echo $adress ?><br />
            <?php echo $cp ?> <?php echo $town ?><br />
            <span>Fixe</span> : <?php echo $landlinePhone ?> - <span>Mobile</span> : <?php echo $mobilePhone ?><br />
            <span>Email</span> : <?php echo $email ?><br />
            <span>Niveau d'Etude</span> : <?php echo $studiesLevel ?><br />
            Permis <?php echo $drivingLicense ?>, <span>Véhicule</span> : <?php echo $vehicle ?><br />
        </div><div class="rightColumn"><img src="image/cv/moi.jpg" id="photoCV" alt="photo lucas girard" /></div>
<div class="readMore"><a href="index.php?module=cv&amp;page=fullCivilState">En savoir +</a></div>
        <?php
    }
    ?>
</fieldset>