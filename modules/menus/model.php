<?php

function getMenu($name, $connection) {
    $menu = '';
    $donneesSQL = select($connection, "SELECT l.id, l.name , l.link FROM menu AS m LEFT JOIN link AS l on m.id = l.MENU_id WHERE m.name=?",array($name));
    foreach ($donneesSQL as $value) {
        $menu .= '<li><a href=\''.$value['link'].'\'>'.$value['name'].'</a></li>';
    }
    return $menu;
}

?>
