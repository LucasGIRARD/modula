<?php /*
  débutant
  intermediaire
  confirmé
  avancé
  expert

  <fieldset><legend>COMPETENCES TECHNIQUES</legend>
  <td>
  <span>Languages de Programmation :</span>
  <ul>
  <li>XHTML</li>
  <li>HTML</li>
  <li>CSS</li>
  <li>PHP</li>
  <li>SQL</li>
  <li>DHTML</li>
  <li>C</li>
  <li>C++</li>
  <li>FLASH AS2/AS3</li>
  <li>Javascript</li>
  </ul>
  <span>Compétences liées aux développements :</span>
  <ul>
  <li>Normes W3C</li>
  <li>Optimisation des pages</li>
  <li>Affiliation</li>
  <li>Administration phpMyAdmin</li>
  <li>Méthode d'analyse, de conception et de réalisation de systèmes d'informations informatisés : Merise</li>
  <li>Utilisation d'un debugger : xdebug</li>
  </ul>
  <span>Connaissances de CMS :</span>
  <ul>
  <li>Framework Symfony</li>
  <li>OScommerce</li>
  </ul>
  <span>Administration serveur :</span>
  <ul>
  <li>installation et configuration diverses (Apache, Active Directory, ...)</li>
  <li>utilisation du protocole SSH</li>
  </ul>
  <span>Utilisation Système d'exploitation (OS) :</span>
  <ul>
  <li>Windows (95, 98, NT4, XP 32 et 64 bits)</li>
  <li>Linux (Damn Small Linux, KNOPPIX)</li>

  <li>Windows Serveur 2003</li>
  <li>Linux Serveur (gentoo, debian)</li>

  <li>Dépannage : Ultimate Boot CD</li>
  </ul>
  <span>Connaissances de logiciels de développement :</span>
  <ul>
  <li>Adobe Dreamweaver</li>
  <li>Microsoft Visual Studio</li>
  <li>netbeans</li>
  <li>notepadd++</li>
  <li>wamp</li>
  <li>xoopserver</li>
  <li>Environnement LAMP (Linux, Apache, MySQL, Php) : Wamp et Xoopserver</li>
  </ul>
  <span>Connaissances de logiciels de graphisme :</span>
  <ul>
  <li>Adobe Flash</li>
  <li>Adobe Photoshop</li>
  <li>GIMP</li>
  <li>SwishMax</li>
  </ul>
  <span>Connaissances de suite bureautique :</span>
  <ul>
  <li>Microsoft Office</li>
  <li>OpenOffice</li>
  </ul>
  <span>Connaissances de navigateurs internet :</span>
  <ul>
  <li>Firefox</li>
  <li>Internet Explorer</li>
  <li>Opera</li>
  <li>Safari</li>
  </ul>
  <span>Langues :</span>
  <ul>
  <li>anglais (Technique).</li>
  </ul>
  <span>Autres :</span>
  <ul>
  <li>Utilisation d’un ordinateur personnel depuis l'âge de 10 ans.</li>
  <li>Installation et configuration hardware et software de PC.</li>
  <li>Donne régulièrement des conseils en hardware auprès de connaissance.</li>
  <li>Dépannage hardware et software de PC, par téléphone, VOIP ou bien sur place.</li>
  <li>Connaissance sur les architectures matériels (processeurs, cartes mères, ...)</li>
  </ul>

  <td class="section">COMPETENCES TECHNIQUES<br />(principale)</td>
  <td>
  Languages de Programmation
  <ul>
  <li>XHTML</li>
  <li>HTML</li>
  <li>CSS</li>
  <li>PHP</li>
  <li>SQL</li>
  </ul>
  Compétences liées aux développements
  <ul>
  <li>Normes W3C</li>
  <li>Optimisation des pages</li>
  <li>Affiliation</li>
  <li>Administration phpMyAdmin</li>
  <li>Méthode d'analyse, de conception et de réalisation de systèmes d'informations informatisés : Merise</li>
  <li>Utilisation d'un debugger : xdebug</li>
  </ul>

  Utilisation Système d'exploitation (OS)
  <ul>
  <li>Windows (95, 98, NT4, XP 32 et 64 bits)</li>
  <li>Linux (Damn Small Linux, KNOPPIX)</li>

  <li>Windows Serveur 2003</li>
  <li>Linux Serveur (gentoo, debian)</li>

  <li>Dépannage : Ultimate Boot CD</li>
  </ul>
  Connaissances de logiciels de développement
  <ul>
  <li>Adobe Dreamweaver</li>
  <li>Microsoft Visual Studio</li>
  <li>netbeans</li>
  <li>notepadd++</li>
  <li>wamp</li>
  <li>xoopserver</li>
  <li>Environnement LAMP (Linux, Apache, MySQL, Php) : Wamp et Xoopserver</li>
  </ul>
  Langues
  <ul>
  <li>anglais (Technique).</li>
  </ul>

  </fieldset>
 */
?>

<fieldset><legend>COMPETENCES TECHNIQUES</legend>
    <?php
    $lastTitle = "";
    foreach ($donneesSQL4 as $donnees) {
        if ($donnees["id"] != $lastTitle) {
            if (!empty($lastTitle)) {
                echo "</ul>";
            }
            echo "<span>" . $donnees["title"] . "</span> :<ul>";
        }

        echo "<li>" . $donnees["skill"] . "</li>";
        $lastTitle = $donnees["id"];
    }
    ?>
</ul>
</fieldset>