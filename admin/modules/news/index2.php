<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = "";
                $day = date("d");
                $month = date("m");
                $year = date("Y");
                $hour = date("H");
                $minute = date("i");
                $author = 0;
                $category = 0;
                $enabled = 0;
                $intro = "";
                $content = "";

                $id = 0;
                break;
            case 'initLists':
                switch ($action) {
                    case 'add':
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT id, firstname, lastname FROM member");

                        foreach ($donneesSQL as $value) {
                            $authors[$value['id']] = $value['lastname'].' '.$value['firstname'];
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT c.id, c.name
                            FROM category AS c
                            LEFT JOIN module AS m ON c.MODULE_id = m.id 
                            WHERE m.alias = 'news' OR m.alias = ''
                            ORDER BY c.name");

                        foreach ($donneesSQL as $value) {
                            $categories[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;



                        break;
                }

                break;
            case 'postVars':
                switch ($action) {
                    case 'added':
                    case 'modified':
                        $id = $_POST['id'];

                        $name = $_POST['name'];
                        $day = $_POST['day'];
                        $month = $_POST['month'];
                        $year = $_POST['year'];
                        $hour = $_POST['hour'];
                        $minute = $_POST['minute'];
                        $author = $_POST['author'];
                        $category = $_POST['category'];
                        $enabled = $_POST['enabled'];
                        $intro = $_POST['intro'];
                        $content = $_POST['content'];

                        if (empty($year)) {
                            $year = '00';
                        }

                        if (empty($month)) {
                            $month = '00';
                        }

                        if (empty($day)) {
                            $day = '00';
                        }

                        if (empty($hour)) {
                            $hour = '00';
                        }

                        if (empty($minute)) {
                            $minute = '00';
                        }

                        $createdDate = $year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $minute . ':00';

                        if (empty($author)) {
                            $author = NULL;
                        }

                        if (empty($category)) {
                            $category = NULL;
                        }

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }
                        break;
                    case 'modifiedParameters':
                        break;
                    default :
                        $id = $_POST['id'];
                        break;
                }

                break;
            case 'postPVars':
                break;
            case 'verifyPost':
                if (!empty($errorField)) {
                    if (count($errorField) == 1) {
                        $errorMessage = 'Le champ suivant n\'a pas été rempli : ' . $errorField[0] . '.';
                    } else {
                        $errorMessage = 'Les champs suivant n\'ont pas été remplis : ' . implode(', ', $errorField) . '.';
                    }
                    $moduleAction = NULL;
                    $moduleAction[0] = 'listView';
                }
                break;
            case 'dbVars':
                switch ($action) {
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT enabled, name, DATE_FORMAT(createdDate,'%Y') AS year, DATE_FORMAT(createdDate,'%m') AS month, DATE_FORMAT(createdDate,'%d') AS day, DATE_FORMAT(createdDate,'%H') AS hour, DATE_FORMAT(createdDate,'%i') AS minute, intro, content, MEMBER_id, CATEGORY_id FROM news WHERE id=?", array($id));

                        list($enabled, $name, $year, $month, $day, $hour, $minute, $intro, $content, $author, $category) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT n.id, n.enabled, n.name, DATE_FORMAT(n.createdDate,'%d/%m/%Y') AS createdDate, m.nick AS author FROM news AS n, member AS m");

                        foreach ($donneesSQL as $value) {
                            $news[$value['id']]['name'] = $value['name'];
                            $news[$value['id']]['enabled'] = $value['enabled'];
                            $news[$value['id']]['createdDate'] = $value['createdDate'];
                            $news[$value['id']]['author'] = $value['author'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO news (enabled, name, createdDate, intro, content, MEMBER_id, CATEGORY_id) VALUES (?,?,?,?,?,?,?)", array(array($enabled, $name, $createdDate, $intro, $content, $author, $category)));
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE news SET enabled=?, name=?, createdDate=?, intro=?, content=?, MEMBER_id=?, CATEGORY_id=? WHERE id=?", array(array($enabled, $name, $createdDate, $intro, $content, $author, $category, $id)));
                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM news WHERE id=?", array(array($id)));
                break;
            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE news SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE news SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/news/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/news/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/news/view_modify.php';
                break;
            case 'parametersView':
                break;
            case 'writeFile':
                switch ($action) {
                    case 'added':
                        break;
                    case 'modified':
                        break;
                }
                break;
            case 'deleteFile':
                break;
        }
    }
}
?>