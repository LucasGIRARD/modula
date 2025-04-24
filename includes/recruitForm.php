<?php

if (isset($_SESSION['pseudo'])) {
$DBC = mysql_connect("localhost", "root", "");
mysql_select_db("creative");
$donneesSQL = mysql_query("SELECT DATE_FORMAT( birthday, '%d/%m/%Y' ) AS birthday, steamFriend, country, department, town FROM member WHERE nick='".$_SESSION['pseudo']."'");
mysql_close($DBC);
$donnees = mysql_fetch_array($donneesSQL);
    ?>

        <div id="recruit">
        <form action="?page=work" method="post">
            <?php
            if (empty($donnees['birthday']) || empty($donnees['steamFriend'])) {
               echo "<fieldset><legend>Complément(s) fiche membre obligatoires : </legend><div>";
               if(empty($donnees['birthday'])){
                   echo "<label for='birth'>Date de naissance :</label><input type='text' name='birthday' id='birth' size='1' maxlength='2' value='' /> / <input type='text' name='birthmonth' size='1' maxlength='2' value=''' /> / <input type='text' name='birthyear' size='2' maxlength='4' value='' /><br />";
               }
               if( empty($donnees['steamFriend'])){
                   echo "<label for='steamFriend'>Steam AMIS :</label><input type='text' size='66' maxlength='45' name='steamFriend' id='steamFriend' value='' />";
               }
                echo"</div></fieldset>"; 
            }
            if (empty($donnees['country']) || empty($donnees['department']) || empty($donnees['town'])) {
               echo "<fieldset><legend>Complément(s) fiche membre optionnels : </legend><div>";
               if(empty($donnees['country'])){
                   echo "<label for='country'>Pays :</label><input type='text' size='45' maxlength='30' name='country' id='country' value='' />";
               }
               if(empty($donnees['department'])){
                   echo "<label for='department'>Département :</label><input type='text' size='45' maxlength='30' name='department' id='department' value='' />";
               }
               if(empty($donnees['town'])){
                   echo "<label for='town'>Ville :</label><input type='text' size='45' maxlength='30' name='town' id='' value='' />";
               }
                echo"</div></fieldset>"; 
            }            
            ?>        
            <fieldset>
                <legend>Informations obligatoires :</legend>
                <div>                    
                    <label for="game">jeu :</label><select name="game" id="game">
                        <option value="1">cs 1.6</option>
                    </select><br />
                    <label for="steamID">Steam ID :</label><input type="text" size="66" maxlength="45" name="steamID" id="steamID" value="" />
                    <label for="nick">pseudo en jeu :</label><input type="text" size="45" maxlength="30" name="nick" id="nick" value="" />
                     <label for="xp">Expérience :</label><input type="text" name="xp" id="xp" size="1" maxlength="2"/> année(s)<br />
                    <label for="level">Niveau :</label><select name="level" id="level">
                        <option value="1">j'en sais rien</option>
                        <option value="2" selected="selected">noob</option>
                        <option value="3">low</option>
                        <option value="4">low+</option>
                        <option value="5">mid</option>
                        <option value="6">mid+</option>
                        <option value="7">high</option>
                    </select><br />
                    <label for="microphone">micro :</label><select name="microphone" id="microphone">
                        <option value="1">off</option>
                        <option value="2">micro lidl en carton</option>
                        <option value="3">on</option>
                        <option value="4">micro de pgm antibruit</option>
                    </select>
                    <label for="TS3">TS3 :</label><select name="TS3" id="TS3">
                        <option value="1">je l'installerais jamais</option>
                        <option value="2">off</option>
                        <option value="3">on</option>
                    </select>
                    <label for="WIRE">esl WIRE :</label><select name="WIRE" id="WIRE">
                        <option value="1">je l'installerais jamais</option>
                        <option value="2">off</option>
                        <option value="3">on</option>
                    </select>
                </div>
                <?php include('includes/dispo.html'); ?>
                <script type="text/javascript" >
                    main();
                </script>
            </fieldset>
            <fieldset>
                <legend>Informations optionnelles :</legend>
                <div>
                    <fieldset>
                        <legend>Arme de prédilection en terroriste:</legend>
                        <label for="TPistol">pistolet :</label><select name="TPistol" id="TPistol">
                            <option value="0"></option>
                            <option value="1">1| 9*19MM SIDEARM(glock)</option>
                            <option value="2">2| KM .45 TACTICAL(usp)</option>
                            <option value="3">3| 228 COMPACT</option>
                            <option value="4">4| NIGHT HAWK .50C(deagle)</option>
                            <option value="5">5| .40 DUAL ELITES(double beretta)</option>
                        </select><br />
                        <label for="TAuto">automatique :</label><select name="TAuto" id="TAuto">
                            <option value="0"></option>
                            <option value="1">1| IDF DEFENDER (galil)</option>
                            <option value="2">2| CV-47 (kalashnikov)</option>
                            <option value="3">3| SCHMIDT SCOUT (scout)</option>
                            <option value="4">4| KRIEG 552 (krieg)</option>
                            <option value="5">5| MAGNUM SNIPER RIFLE (awp)</option>
                            <option value="6">6| D3/AU-1 (snipe auto)</option>
                        </select>
                        </fieldset>
                        <fieldset>
                        <legend>Arme de prédilection en counter-terroriste:</legend>
                        <label for="CTPistol">pistolet :</label><select name="CTPistol" id="CTPistol">
                            <option value="0"></option>
                            <option value="1">1| 9*19MM SIDEARM (glock)</option>
                            <option value="2">2| KM .45 TACTICAL (usp)</option>
                            <option value="3">3| 228 COMPACT</option>
                            <option value="4">4| NIGHT HAWK .50C (deagle)</option>
                            <option value="5">5| ES FIVE-SEVEN (five seven)</option>
                        </select><br />
                        <label for="CTAuto">automatique :</label><select name="CTAuto" id="CTAuto">
                            <option value="0"></option>
                            <option value="1">1| CLARION5 (famas)</option>
                            <option value="2">2| SCHMIDT SCOUT (scout)</option>
                            <option value="3">3| MAVERICK M4A1 CARBINE (m4a1)</option>
                            <option value="4">4| BULLPUP (aug-sig)</option>
                            <option value="5">5| KRIEG 550 COMMANDO (snipe auto)</option>
                            <option value="6">6| MAGNUM SNIPER RIFLE (awp)</option>
                        </select>
                    </fieldset><br />
                    <label for="knowUs">Comment avez-vous entendu parler de nous ? :</label><select name="knowUs" id="knowUs">
                        <option value="0"></option>
                        <option value="1">forum</option>
                        <option value="2">in-game</option>
                        <option value="3">top-site</option>
                        <option value="4">notre serveur</option>
                        <option value="5">irc</option>
                    </select><br />
                    <label for="other">Autre(s) :</label><textarea name="other" id="other" cols="30" rows="5"></textarea>
                   </div>
            </fieldset>
            <input type="hidden" name="action" value="recruit" />
            <input type="submit" value="Envoyer" />
        </form>
    </div>
    <?php
} else {
    echo "<br /><br />Vous devez être inscrit pour pouvoir effectuer une demande de recrutement.<br /><br />Veuillez vous connecter à votre compte ou si cela n'est pas encore fait, vous enregister.<br /><br /><br />";
}
?>