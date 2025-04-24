<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => $value) {
        switch ($value) {
            case 'initVars':
                switch ($action) {
                    case 'add':
                        $step = 0;
                        $nextStep = 1;
                        $member = 0;
                        $name = "";
                        $telework = 0;
                        $annualRemunerationStart = "";
                        $annualRemunerationEnd = "";
                        $enabled = 0;
                        $id = 0;
                        break;
                    case 'addedStep':
                        $nextStep = $step + 1;
                        $adress = 0;
                        $email = 0;
                        $landline = 0;
                        $mobile = 0;
                        break;
                }

                break;
            case 'initLists':
                switch ($action) {
                    case 'add':
                        $members = array();

                        $donneesSQL = select($connection, "SELECT id, nick, firstName, lastName FROM member");

                        foreach ($donneesSQL as $value) {
                            $members[$value['id']] = $value['firstName'] . ' ' . $value['lastName'] . ' ( ' . $value['nick'] . ' )';
                        }

                        $donneesSQL = NULL;
                        break;
                    case 'addedStep':

                        $adresss = array();

                        $donneesSQL = select($connection, "SELECT id, name FROM adress");

                        foreach ($donneesSQL as $value) {
                            $adresss[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;

                        $emails = array();

                        $donneesSQL = select($connection, "SELECT id, email FROM email_adress");

                        foreach ($donneesSQL as $value) {
                            $emails[$value['id']] = $value['email'];
                        }

                        $donneesSQL = NULL;

                        $landlines = array();

                        $donneesSQL = select($connection, "SELECT p.id, p.name, p.number FROM phone AS p LEFT JOIN phone_type AS pt ON pt.id = p.PHONE_TYPE_id WHERE p.MEMBER_id = $member AND pt.alias = 'landline'");

                        foreach ($donneesSQL as $value) {
                            $landlines[$value['id']] = $value['number'] . ' ( ' . $value['name'] . ' )';
                        }

                        $donneesSQL = NULL;

                        $mobiles = array();

                        $donneesSQL = select($connection, "SELECT p.id, p.name, p.number FROM phone AS p LEFT JOIN phone_type AS pt ON pt.id = p.PHONE_TYPE_id WHERE p.MEMBER_id = $member AND pt.alias = 'mobile'");

                        foreach ($donneesSQL as $value) {
                            $mobiles[$value['id']] = $value['number'] . ' ( ' . $value['name'] . ' )';
                        }

                        $donneesSQL = NULL;

                        $workExperienceTypes = array();

                        break;
                    case 'modify':

                        $members = array();

                        $donneesSQL = select($connection, "SELECT id, nick, firstName, lastName FROM member");

                        foreach ($donneesSQL as $value) {
                            $members[$value['id']] = $value['firstName'] . ' ' . $value['lastName'] . ' ( ' . $value['nick'] . ' )';
                        }

                        $donneesSQL = NULL;

                        $adresss = array();

                        $donneesSQL = select($connection, "SELECT id, name FROM adress WHERE MEMBER_id = $member");

                        foreach ($donneesSQL as $value) {
                            $adresss[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;

                        $emails = array();

                        $donneesSQL = select($connection, "SELECT id, email FROM email_adress WHERE MEMBER_id = $member");

                        foreach ($donneesSQL as $value) {
                            $emails[$value['id']] = $value['email'];
                        }

                        $donneesSQL = NULL;

                        $landlines = array();

                        $donneesSQL = select($connection, "SELECT p.id, p.name, p.number FROM phone AS p LEFT JOIN phone_type AS pt ON pt.id = p.PHONE_TYPE_id WHERE p.MEMBER_id = $member AND pt.alias = 'landline'");

                        foreach ($donneesSQL as $value) {
                            $landlines[$value['id']] = $value['number'] . ' ( ' . $value['name'] . ' )';
                        }

                        $donneesSQL = NULL;

                        $mobiles = array();

                        $donneesSQL = select($connection, "SELECT p.id, p.name, p.number FROM phone AS p LEFT JOIN phone_type AS pt ON pt.id = p.PHONE_TYPE_id WHERE p.MEMBER_id = $member AND pt.alias = 'mobile'");

                        foreach ($donneesSQL as $value) {
                            $mobiles[$value['id']] = $value['number'] . ' ( ' . $value['name'] . ' )';
                        }

                        $donneesSQL = NULL;

                        $workExperienceTypes = array();

                        $donneesSQL = select($connection, "SELECT id, name FROM resume_work_experience_type");

                        foreach ($donneesSQL as $value) {
                            $workExperienceTypes[$value['id']] = $value['name'];
                        }

                        $donneesSQL = NULL;                       

                        break;
                    case 'modifiedPart':
                        break;
                }

                break;
            case 'postVars':
                $id = $_POST['id'];

                switch ($action) {
                    case 'added':
                        break;
                    case 'modified':
                        break;
                    case 'modifiedParameters':
                        break;
                }

                break;
            case 'postStepVars':
                $step = $_POST['step'];
                switch ($step) {
                    case '1':
                        $member = $_POST['member'];
                        $name = $_POST['name'];
                        $enabled = $_POST['enabled'];
                        $telework = $_POST['telework'];
                        $annualRemunerationStart = $_POST['annualRemunerationStart'];
                        $annualRemunerationEnd = $_POST['annualRemunerationEnd'];
                        
                        $errorField = array();

                        if (empty($name)) {
                            array_push($errorField, 'nom');
                        }
                        break;
                    case '2':
                        $adress = $_POST['adress'];
                        $email = $_POST['email'];
                        $landline = $_POST['landline'];
                        $mobile = $_POST['mobile'];                        
                        break;
                }
                break;
            case 'postPartVars':
                switch ($action) {
                    case 'modifiedPart':
                        break;
                    case 'deletePart':
                        break;
                }
                break;
            case 'postPVars':

                break;
            case 'dbVars':

                switch ($action) {
                    case 'listing':
                        $donneesSQL = select($connection, "SELECT r.id, r.enabled, m.firstName, m.lastName FROM resume AS r LEFT JOIN member AS m ON m.id = r.MEMBER_id");


                        foreach ($donneesSQL as $value) {
                            $resumes[$value['id']]['name'] = mb_ucfirst($value['firstName']) . ' ' . mb_strtoupper($value['lastName']);
                            $resumes[$value['id']]['enabled'] = $value['enabled'];
                        }

                        $donneesSQL = NULL;
                        break;
                    case 'added':                        
                        break;
                    case 'addedStep':
                        
                        
                        
                        break;
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT name, EMAIL_ADRESS_id, ADRESS_id, telework, annualRemunerationStart, annualRemunerationEnd, enabled, LANDLINE_PHONE_id, MOBILE_PHONE_id, MEMBER_id FROM resume WHERE id = ?", array($id));

                        list($name, $email, $adress, $telework, $annualRemunerationStart, $annualRemunerationEnd, $enabled, $landline, $mobile, $member) = $donneesSQL[0];

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT rwe.id, rwet.name AS type, DATE_FORMAT(rwe.startDate,'%Y') AS startYear, DATE_FORMAT(rwe.startDate,'%m') AS startMonth, DATE_FORMAT(rwe.startDate,'%d') AS startDay, DATE_FORMAT(rwe.endDate,'%Y') AS endYear, DATE_FORMAT(rwe.endDate,'%m') AS endMonth, DATE_FORMAT(rwe.endDate,'%d') AS endDay, rwec.name AS company, rwes.name AS situation, rwesk.name AS skill FROM resume_work_experience AS rwe LEFT JOIN resume_work_experience_type AS rwet ON rwe.RESUME_WORK_EXPERIENCE_TYPE_id = rwet.id LEFT JOIN resume_work_experience_has_situation AS rweHs ON rweHs.RESUME_WORK_EXPERIENCE_id = rwe.id LEFT JOIN resume_work_experience_situation AS rwes ON rweHs.RESUME_WORK_EXPERIENCE_SITUATION_id = rwes.id LEFT JOIN resume_work_experience_skill AS rwesk ON rwesk.RESUME_WORK_EXPERIENCE_id = rwe.id LEFT JOIN resume_work_experience_company AS rwec ON rwe.RESUME_WORK_EXPERIENCE_COMPANY_id = rwec.id WHERE rwe.MEMBER_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $workExperiences[$value['id']]['type'] = $value['type'];

                            $workExperiences[$value['id']]['startYear'] = $value['startYear'];
                            $workExperiences[$value['id']]['startMonth'] = $value['startMonth'];
                            $workExperiences[$value['id']]['startDay'] = $value['startDay'];
                            $workExperiences[$value['id']]['endYear'] = $value['endYear'];
                            $workExperiences[$value['id']]['endMonth'] = $value['endMonth'];
                            $workExperiences[$value['id']]['endDay'] = $value['endDay'];

                            $workExperiences[$value['id']]['company'] = $value['company'];
                            $workExperiences[$value['id']]['situation'] = $value['situation'];
                            $workExperiences[$value['id']]['skill'] = $value['skill'];
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT re.id, 
                            DATE_FORMAT(re.startDate,'%Y') AS startYear, DATE_FORMAT(re.startDate,'%m') AS startMonth, DATE_FORMAT(re.startDate,'%d') AS startDay,
                            DATE_FORMAT(re.endDate,'%Y') AS endYear, DATE_FORMAT(re.endDate,'%m') AS endMonth, DATE_FORMAT(re.endDate,'%d') AS endDay,
                            res.name AS school, res.town, red.name AS degree, reds.name AS specialty, redso.name AS `option`
                            FROM resume_education AS re
                            LEFT JOIN resume_education_school AS res ON re.RESUME_EDUCATION_SCHOOL_id = res.id
                            LEFT JOIN resume_education_degree AS red ON re.RESUME_EDUCATION_DEGREE_id = red.id
                            LEFT JOIN resume_education_degree_speciality AS reds ON re.RESUME_EDUCATION_DEGREE_SPECIALITY_id = reds.id
                            LEFT JOIN resume_education_degree_speciality_option AS redso ON re.RESUME_EDUCATION_DEGREE_SPECIALITY_OPTION_id = redso.id
                            WHERE re.MEMBER_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $educations[$value['id']]['startYear'] = $value['startYear'];
                            $educations[$value['id']]['startMonth'] = $value['startMonth'];
                            $educations[$value['id']]['startDay'] = $value['startDay'];
                            $educations[$value['id']]['endYear'] = $value['endYear'];
                            $educations[$value['id']]['endMonth'] = $value['endMonth'];
                            $educations[$value['id']]['endDay'] = $value['endDay'];

                            $educations[$value['id']]['degree'] = $value['degree'];
                            $educations[$value['id']]['specialty'] = $value['specialty'];
                            $educations[$value['id']]['option'] = $value['option'];
                            $educations[$value['id']]['school'] = $value['school'];
                            $educations[$value['id']]['town'] = $value['town'];
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT id, name AS skill, RESUME_SKILL_TITLE_id AS category FROM resume_skill WHERE MEMBER_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $skills[$value['id']]['category'] = $value['category'];
                            $skills[$value['id']]['skill'] = $value['skill'];
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT id, name AS activitie, RESUME_ACTIVITIES_TITLE_id AS category FROM resume_activities WHERE MEMBER_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $activities[$value['id']]['category'] = $value['category'];
                            $activities[$value['id']]['activitie'] = $value['activitie'];
                        }

                        $donneesSQL = NULL;

                        break;
                    case 'modified':
                        $donneesSQL = select($connection, "SELECT r.id, r.enabled, m.firstName, m.lastName FROM resume AS r LEFT JOIN member AS m ON m.id = r.MEMBER_id");

                        foreach ($donneesSQL as $value) {
                            $resumes[$value['id']]['name'] = mb_ucfirst($value['firstName']) . ' ' . mb_strtoupper($value['lastName']);
                            $resumes[$value['id']]['enabled'] = $value['enabled'];
                        }

                        $donneesSQL = NULL;
                        break;
                    case 'modifiedPart':
                        break;
                    default:
                        $donneesSQL = select($connection, "SELECT r.id, r.enabled, m.firstName, m.lastName FROM resume AS r LEFT JOIN member AS m ON m.id = r.MEMBER_id");

                        foreach ($donneesSQL as $value) {
                            $resumes[$value['id']]['name'] = mb_ucfirst($value['firstName']) . ' ' . mb_strtoupper($value['lastName']);
                            $resumes[$value['id']]['enabled'] = $value['enabled'];
                        }

                        $donneesSQL = NULL;
                        break;
                }
                break;
            case 'insertDb':

                break;
            case 'insertStepDb':
                switch ($step) {
                    case '1':
                        $queryOK = insertUpdate($connection, "INSERT INTO resume (MEMBER_id, name, enabled, telework, annualRemunerationStart, annualRemunerationEnd) VALUES (?,?,?,?,?,?)", array(array($member, $name, $enabled, $telework, $annualRemunerationStart, $annualRemunerationEnd)));
                        $id = getLastId($connection);
                        break;
                    case '2':
                        $queryOK = insertUpdate($connection, "UPDATE resume SET ADRESS_id=?, EMAIL_ADRESS_id=?, LANDLINE_PHONE_id=?, MOBILE_PHONE_id=? WHERE id=?", array(array($adress, $email, $landline, $mobile, $id)));

                        break;
                }

                break;
            case 'updateDb':
                if (!empty($errorField)) {
                    if (count($errorField) == 1) {
                        $errorMessage = 'Le champ suivant n\'a pas été rempli : ' . $errorField[0] . '.';
                    } else {
                        $errorMessage = 'Les champs suivant n\'ont pas été remplis : ' . implode(', ', $errorField) . '.';
                    }
                    $moduleAction = NULL;
                    $moduleAction[0] = 'listView';
                } else {
                    $queryOK = insertUpdate($connection, "UPDATE resume SET name=?, EMAIL_ADRESS_id=?, ADRESS_id=?, telework=?, annualRemunerationStart=?, annualRemunerationEnd=?, enabled=?, LANDLINE_PHONE_id=?, MOBILE_PHONE_id=?, MEMBER_id=? WHERE id=?", array(array($name, $email, $adress, $telework, $annualRemunerationStart, $annualRemunerationEnd, $enabled, $landline, $mobile, $member, $id)));
                }
                break;
            case 'updatePartDb':

                break;
            case 'deleteDb':
                $queryOK = insertUpdate($connection, "DELETE FROM resume WHERE id=?", array(array($id)));
                break;
            case 'deletePartDb':

                break;
            case 'enableDb':
                $queryOK = insertUpdate($connection, "UPDATE resume SET enabled=1 WHERE id=?", array(array($id)));
                break;
            case 'disableDb':
                $queryOK = insertUpdate($connection, "UPDATE resume SET enabled=0 WHERE id=?", array(array($id)));
                break;
            case 'dbPVars':

                break;
            case 'updatePDb':

                break;
            case 'listView':

                $contentView = 'modules/resumes/view.php';

                break;
            case 'addView':
                $actionDisplay = "Ajouter";
                $contentView = 'modules/resumes/view_add.php';
                break;
            case 'nextView':
                $actionDisplay = "Ajouter";
                $contentView = 'modules/resumes/view_add_' . $nextStep . '.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $contentView = 'modules/resumes/view_modify.php';
                break;
            case 'parametersView':
                break;
            case 'writeFile':
                switch ($action) {
                    case 'added':
                        break;
                    case 'addedStep':
                        break;
                    case 'addedStep':
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