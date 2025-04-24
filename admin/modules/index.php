<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'post':
                $id = $_POST['id'];
                break;
            case 'getDB':
                $donneesSQL = select($connection, "SELECT id, name, enabled, system FROM module");

                foreach ($donneesSQL as $value) {
                    $modules[$value['id']]['name'] = $value['name'];
                    $modules[$value['id']]['enabled'] = $value['enabled'];
                    $modules[$value['id']]['system'] = $value['system'];
                }

                $donneesSQL = NULL;
                break;
            case 'pushDB':
                switch ($action) {
                    case 'added':
                        break;
                    case 'delete':
                        break;
                    case 'enable':
                        $queryOK = insertUpdate($connection, "UPDATE module SET enabled=1 WHERE id=?", array(array($id)));
                        break;
                    case 'disable':
                        $queryOK = insertUpdate($connection, "UPDATE module SET enabled=0 WHERE id=? OR parentId=?", array(array($id, $id)));
                        break;
                    case 'modifiedParameters':
                        break;
                    default:
                        break;
                }
                break;
            case 'view':
                $contentView = 'modules/view.php';

                break;

            default:
                break;
        }
    }
}
?>