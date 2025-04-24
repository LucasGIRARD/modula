<?php
function getMenu($name, $connection) {
    $menu = '';
    $donneesSQL = select($connection, "SELECT l.id, l.name , l.link FROM menu AS m LEFT JOIN link AS l on m.id = l.MENU_id WHERE m.name=?", array($name));
    foreach ($donneesSQL as $value) {
        $menu .= '<li><a href=\'' . $value['link'] . '\'>' . $value['name'] . '</a></li>';
    }
    $donneesSQL = NULL;
    return $menu;
}

function getAdminMenu($connection) {
    $menu = '<ul><li><a href=\'index.php?page=home\'>Accueil</a></li>';
    $menu .= '<li><a href=\'index.php?page=configuration\'>Configuration</a></li>';
    $menu .= '<li><a href=\'index.php?page=modules\'>Modules 1</a><ul>';

    
    $donneesSQL = select($connection, "SELECT id, name, alias, parentId FROM module WHERE enabled=1 AND MODULE_TYPE_id=1");
    
    foreach ($donneesSQL as $value) {
        $menu .= '<li><a href=\'index.php?module=' . $value['alias'] . '\'>' . $value['name'] . '</a></li>';        
    }
    
    $donneesSQL = NULL;
    
    $menu .= '</ul></li><li><a href=\'index.php?page=modules\'>Modules 2</a><ul>';
    
    $donneesSQL = select($connection, "SELECT id, name, alias, parentId FROM module WHERE enabled=1 AND MODULE_TYPE_id=2");

    foreach ($donneesSQL as $value) {
        if (!empty($value['parentId'])) {
            $links[$value['parentId']]['child'][$value['id']]['name'] = mb_ucfirst($value['name'], true);
            $links[$value['parentId']]['child'][$value['id']]['alias'] = $value['alias'];
        } else {
            $links[$value['id']]['name'] = mb_ucfirst($value['name'], true);
            $links[$value['id']]['alias'] = $value['alias'];
        }
    }    
    
    $donneesSQL = NULL;
    
    foreach ($links as $key => $value) {
        $menu .= '<li><a href=\'index.php?module=' . $value['alias'] . '\'>' . $value['name'] . '</a>';
        if (isset($value['child'])) {
            $menu .= '<ul>';
            foreach ( $value['child'] as $key => $value) {                
                $menu .= '<li><a href=\'index.php?module=' . $value['alias'] . '\'>' . $value['name'] . '</a></li>';
            }
            $menu .= '</ul>';
        }
        $menu .= '</li>';
    }
    
    $links = NULL;    
    

    $menu .= '</ul></li><li><a href=\'index.php?page=credits\'>Crédits</a></li></ul>';

    return $menu;
}

?>
