<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
        switch ($value) {
            case 'initVars':
                $name = '';
                $day = date("d");
                $month = date("m");
                $year = date("Y");
                $hour = date("H");
                $minute = date("i");

                $password = '';
                $passwordC = '';
                $enabled = '';
                $lastname = '';
                $firstname = '';
                $gender = '';
                $birthday = '';
                $birthplace = '';

                $emails = array();
                $adresss = array();

                $id = 0;
                break;
            case 'initLists':
                $emails = array();
                $adresss = array();
                
                $donneesSQL = select($connection, "SELECT id, email FROM email_adress WHERE MEMBER_id=?", array($id));
                                
                foreach ($donneesSQL as $value) {
                    
                    $emails[$value['id']] = $value['email'];                    
                }
                
                $donneesSQL = NULL;
                
                $donneesSQL = select($connection, "SELECT id, name, adress, cp, town, country, department FROM adress WHERE MEMBER_id=?", array($id));
                                
                foreach ($donneesSQL as $value) {
                    
                    if (!empty($value['name'])) {
                        $adresss[$value['id']]['legendName'] = $value['legendName'];
                    } else {
                        $adresss[$value['id']]['legendName'] = 'Adresse sans nom';
                    }
                    
                    $adresss[$value['id']]['name'] = $value['name'];
                    $adresss[$value['id']]['adress'] = $value['adress'];
                    $adresss[$value['id']]['cp'] = $value['cp'];
                    $adresss[$value['id']]['town'] = $value['town'];
                    $adresss[$value['id']]['country'] = $value['country'];
                    $adresss[$value['id']]['department'] = $value['department'];
                }
                
                $donneesSQL = NULL;
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
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $passwordC = $_POST['passwordC'];
                        $enabled = $_POST['enabled'];
                        $lastname = $_POST['lastname'];
                        $firstname = $_POST['firstname'];
                        $gender = $_POST['gender'];
                        $birthday = $_POST['birthday'];
                        $birthplace = $_POST['birthplace'];

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

                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }

                        if ($password != $passwordC) {
                            array_push($errorField, 'password');
                        }
                        break;
                    case 'modifiedParameters':
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
                    case 'added':
                        break;
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT nick, DATE_FORMAT(createdDate,'%d') AS day, DATE_FORMAT(createdDate,'%m') AS month, DATE_FORMAT(createdDate,'%Y') AS year, DATE_FORMAT(createdDate,'%H') AS hour, DATE_FORMAT(createdDate,'%i') AS minute, enabled, lastname, firstname, gender, birthday, birthplace FROM member WHERE id=?", array($id));

                        list($name, $day, $month, $year, $hour, $minute, $enabled, $lastname, $firstname, $gender, $birthday, $birthplace) = $donneesSQL[0];

                        $donneesSQL = NULL;
                        break;
                    case 'modified':
                        break;
                    default:
                        $memberPerPage = 100;
                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                            $pageMember = $_GET['id'];
                        } else {
                            $pageMember = 1;
                        }
                        $firstLimit = ($pageMember - 1) * $memberPerPage;
                        $totalMember = select($connection, "SELECT COUNT(*) AS nbMember FROM member");
                        $nbPages = ceil($totalMember[0]['nbMember'] / $memberPerPage);
                        $totalMember = NULL;
                        $donneesSQL = select($connection, "SELECT id, nick FROM member AS m ORDER BY m.id DESC LIMIT  $firstLimit, $memberPerPage");

                        foreach ($donneesSQL as $value) {
                            $members[$value['id']]['nick'] = $value['nick'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':
                $queryOK = insertUpdate($connection, "INSERT INTO member (nick, createdDate, email, enabled, lastname, firstname, gender, birthday, birthplace) VALUES (?,?,?,?,?,?,?,?,?)", array(array($name, $createdDate, $email, $enabled, $lastname, $firstname, $gender, $birthday, $birthplace)));
                        $id = getLastId($connection);
                break;
            case 'updateDb':
                $queryOK = insertUpdate($connection, "UPDATE member SET name=?, createdDate=?, email=?, enabled=?, lastname=?, firstname=?, gender=?, birthday=?, birthplace=? WHERE id=?", array(array($name, $createdDate, $email, $enabled, $lastname, $firstname, $gender, $birthday, $birthplace, $id)));
                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM member WHERE id=?", array(array($id)));
                break;

            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE member SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE member SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':
                break;
            case 'updatePDb':
                break;
            case 'listView':
                $contentView = 'modules/members/view.php';
                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $action = 'added';
                $contentView = 'modules/members/view_modify.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
                $contentView = 'modules/members/view_modify.php';
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