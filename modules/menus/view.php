<?php
if (isset($donneesSQL) && !empty($donneesSQL)) {
  echo '<ul>';
   foreach ($donneesSQL as $donnees) {        
       echo '<li><a href="'. $donnees['link'] .'">'. $donnees['name'] .'</a></li>';        
    }
echo '</ul>';  
}
?>