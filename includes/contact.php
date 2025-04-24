<?php
if (!isset($_SESSION['pseudo'])) {
    echo "Vous devez être inscrit pour pouvoir nous contacter.";
} else {
    ?>
    <div id="contact">
        <form action='?page=work' method='post'>
            <div>
                <label for="object">Objet :</label><select name="object" id="object">
                    <option value="1">ban par erreur</option>
                    <option value="2">demande de match</option>
                    <option value="3">bug site</option>
                    <option value="4">bug serveur</option>
                    <option value="5">autres</option>
                </select><br />
                <label for="message">Votre message :</label><textarea name="message" id="message" cols="30" rows="5"></textarea>
            </div>
            <input type='hidden' name='action' value='contact' />
            <input type="submit" value="Envoyer" />
        </form>
    </div>
    <?php
}
?>
