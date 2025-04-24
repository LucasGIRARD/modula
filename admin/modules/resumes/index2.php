<?php

if (isset($moduleAction)) {
    foreach ($moduleAction as $key => &$value) {
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
                        $member = $_POST['member'];
                        $name = $_POST['name'];
                        $enabled = $_POST['enabled'];
                        $telework = $_POST['telework'];
                        $adress = $_POST['adress'];
                        $email = $_POST['email'];
                        $mobile = $_POST['mobile'];
                        $landline = $_POST['landline'];
                        $annualRemunerationStart = $_POST['annualRemunerationStart'];
                        $annualRemunerationEnd = $_POST['annualRemunerationEnd'];

                        if (isset($_POST['resumeWE'])) {
                            $resumeWE = $_POST['resumeWE'];
                        } else {
                            $resumeWE = array();
                        }

                        if (isset($_POST['resumeEducation'])) {
                            $resumeEducation = $_POST['resumeEducation'];
                        } else {
                            $resumeEducation = array();
                        }

                        if (isset($_POST['resumeSkills'])) {
                            $resumeSkills = $_POST['resumeSkills'];
                        } else {
                            $resumeSkills = array();
                        }

                        if (isset($_POST['resumeActivities'])) {
                            $resumeActivities = $_POST['resumeActivities'];
                        } else {
                            $resumeActivities = array();
                        }

                        $resumeWEOld = explode(", ", $_POST['resumeWEOld']);
                        $resumeEducationOld = explode(", ", $_POST['resumeEducationOld']);
                        $resumeSkillsOld = explode(", ", $_POST['resumeSkillsOld']);
                        $resumeActivitiesOld = explode(", ", $_POST['resumeActivitiesOld']);

                        break;
                    case 'modifiedParameters':
                        break;
                }

                break;
            case 'postStepVars':
                $step = $_POST['step'];
                $id = $_POST['id'];
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
                        $mobile = $_POST['mobile'];
                        $landline = $_POST['landline'];


                        if (isset($_POST['resumeWE'])) {
                            $resumeWE = $_POST['resumeWE'];
                        } else {
                            $resumeWE = array();
                        }

                        if (isset($_POST['resumeEducation'])) {
                            $resumeEducation = $_POST['resumeEducation'];
                        } else {
                            $resumeEducation = array();
                        }

                        if (isset($_POST['resumeSkills'])) {
                            $resumeSkills = $_POST['resumeSkills'];
                        } else {
                            $resumeSkills = array();
                        }

                        if (isset($_POST['resumeActivities'])) {
                            $resumeActivities = $_POST['resumeActivities'];
                        } else {
                            $resumeActivities = array();
                        }





                        $resumeWEOld = explode(", ", $_POST['resumeWEOld']);
                        $resumeEducationOld = explode(", ", $_POST['resumeEducationOld']);
                        $resumeSkillsOld = explode(", ", $_POST['resumeSkillsOld']);
                        $resumeActivitiesOld = explode(", ", $_POST['resumeActivitiesOld']);

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
                        $donneesSQL = select($connection, "SELECT r.id, r.name,r.enabled, m.firstName, m.lastName FROM resume AS r LEFT JOIN member AS m ON m.id = r.MEMBER_id");


                        foreach ($donneesSQL as $value) {
                            $resumes[$value['id']]['member'] = mb_ucfirst($value['firstName']) . ' ' . mb_strtoupper($value['lastName']);
                            $resumes[$value['id']]['name'] = $value['name'];
                            $resumes[$value['id']]['enabled'] = $value['enabled'];
                        }

                        $donneesSQL = NULL;
                        break;
                    case 'added':
                        break;
                    case 'addedStep':
                        $donneesSQL = select($connection, "SELECT EMAIL_ADRESS_id, ADRESS_id, LANDLINE_PHONE_id, MOBILE_PHONE_id, MEMBER_id FROM resume WHERE id = ?", array($id));

                        list($email, $adress, $landline, $mobile, $member) = $donneesSQL[0];

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT rwe.id, rwet.name AS type, 
                            DATE_FORMAT(rwe.startDate,'%Y') AS startYear, DATE_FORMAT(rwe.startDate,'%m') AS startMonth, DATE_FORMAT(rwe.startDate,'%d') AS startDay, 
                            DATE_FORMAT(rwe.endDate,'%Y') AS endYear, DATE_FORMAT(rwe.endDate,'%m') AS endMonth, DATE_FORMAT(rwe.endDate,'%d') AS endDay, 
                            rwec.name AS company, rwes.name AS situation, rwesk.name AS skill 
                            FROM resume_work_experience AS rwe 
                            LEFT JOIN resume_work_experience_type AS rwet ON rwe.RESUME_WORK_EXPERIENCE_TYPE_id = rwet.id 
                            LEFT JOIN resume_work_experience_has_situation AS rweHs ON rweHs.RESUME_WORK_EXPERIENCE_id = rwe.id 
                            LEFT JOIN resume_work_experience_situation AS rwes ON rweHs.RESUME_WORK_EXPERIENCE_SITUATION_id = rwes.id 
                            LEFT JOIN resume_work_experience_skill AS rwesk ON rwesk.RESUME_WORK_EXPERIENCE_id = rwe.id 
                            LEFT JOIN resume_work_experience_company AS rwec ON rwe.RESUME_WORK_EXPERIENCE_COMPANY_id = rwec.id 
                            WHERE rwe.MEMBER_id = ?", array($member));

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

                            $workExperiences[$value['id']]['active'] = 0;
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
                            WHERE re.MEMBER_id = ?", array($member));

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

                            $educations[$value['id']]['active'] = 0;
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT rs.id, rs.name AS skill, rst.name AS category 
                            FROM resume_skill AS rs 
                            LEFT JOIN resume_skill_title AS rst ON rs.RESUME_SKILL_TITLE_id = rst.id 
                            WHERE MEMBER_id = ?", array($member));

                        foreach ($donneesSQL as $value) {
                            $skills[$value['id']]['category'] = $value['category'];
                            $skills[$value['id']]['skill'] = $value['skill'];
                            $skills[$value['id']]['active'] = 0;
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT ra.id, ra.name AS activitie, rat.name AS category 
                            FROM resume_activities AS ra
                            LEFT JOIN resume_activities_title AS rat ON ra.RESUME_ACTIVITIES_TITLE_id = rat.id
                            WHERE MEMBER_id = ?", array($member));

                        foreach ($donneesSQL as $value) {
                            $activities[$value['id']]['category'] = $value['category'];
                            $activities[$value['id']]['activitie'] = $value['activitie'];
                            $activities[$value['id']]['active'] = 0;
                        }

                        $donneesSQL = NULL;

                        $resumeWEOld = array();
                        $donneesSQL = select($connection, "SELECT RESUME_WORK_EXPERIENCE_id AS id FROM resume_has_resume_work_experience WHERE RESUME_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $workExperiences[$value['id']]['active'] = 1;
                            array_push($resumeWEOld, $value['id']);
                        }

                        $donneesSQL = NULL;
                        $resumeWEOld = implode(", ", $resumeWEOld);

                        $resumeEducationOld = array();
                        $donneesSQL = select($connection, "SELECT RESUME_EDUCATION_id AS id FROM resume_has_resume_education WHERE RESUME_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $educations[$value['id']]['active'] = 1;
                            array_push($resumeEducationOld, $value['id']);
                        }

                        $donneesSQL = NULL;
                        $resumeEducationOld = implode(", ", $resumeEducationOld);

                        $resumeSkillsOld = array();
                        $donneesSQL = select($connection, "SELECT RESUME_SKILL_id AS id FROM resume_has_resume_skill WHERE RESUME_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $skills[$value['id']]['active'] = 1;
                            array_push($resumeSkillsOld, $value['id']);
                        }

                        $donneesSQL = NULL;
                        $resumeSkillsOld = implode(", ", $resumeSkillsOld);

                        $resumeActivitiesOld = array();
                        $donneesSQL = select($connection, "SELECT RESUME_ACTIVITIES_id AS id FROM resume_has_resume_activities WHERE RESUME_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $activities[$value['id']]['active'] = 1;
                            array_push($resumeActivitiesOld, $value['id']);
                        }

                        $donneesSQL = NULL;
                        $resumeActivitiesOld = implode(", ", $resumeActivitiesOld);

                        break;
                    case 'modify':
                        $donneesSQL = select($connection, "SELECT name, EMAIL_ADRESS_id, ADRESS_id, telework, annualRemunerationStart, annualRemunerationEnd, enabled, LANDLINE_PHONE_id, MOBILE_PHONE_id, MEMBER_id 
                            FROM resume WHERE id = ?", array($id));

                        list($name, $email, $adress, $telework, $annualRemunerationStart, $annualRemunerationEnd, $enabled, $landline, $mobile, $member) = $donneesSQL[0];

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT rwe.id, rwet.name AS type, 
                            DATE_FORMAT(rwe.startDate,'%Y') AS startYear, DATE_FORMAT(rwe.startDate,'%m') AS startMonth, DATE_FORMAT(rwe.startDate,'%d') AS startDay, 
                            DATE_FORMAT(rwe.endDate,'%Y') AS endYear, DATE_FORMAT(rwe.endDate,'%m') AS endMonth, DATE_FORMAT(rwe.endDate,'%d') AS endDay, 
                            rwec.name AS company, rwes.name AS situation, rwesk.name AS skill 
                            FROM resume_work_experience AS rwe 
                            LEFT JOIN resume_work_experience_type AS rwet ON rwe.RESUME_WORK_EXPERIENCE_TYPE_id = rwet.id 
                            LEFT JOIN resume_work_experience_has_situation AS rweHs ON rweHs.RESUME_WORK_EXPERIENCE_id = rwe.id 
                            LEFT JOIN resume_work_experience_situation AS rwes ON rweHs.RESUME_WORK_EXPERIENCE_SITUATION_id = rwes.id 
                            LEFT JOIN resume_work_experience_skill AS rwesk ON rwesk.RESUME_WORK_EXPERIENCE_id = rwe.id 
                            LEFT JOIN resume_work_experience_company AS rwec ON rwe.RESUME_WORK_EXPERIENCE_COMPANY_id = rwec.id 
                            WHERE rwe.MEMBER_id = ?", array($member));

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

                            $workExperiences[$value['id']]['active'] = 0;
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
                            WHERE re.MEMBER_id = ?", array($member));

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

                            $educations[$value['id']]['active'] = 0;
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT rs.id, rs.name AS skill, rst.name AS category 
                            FROM resume_skill AS rs 
                            LEFT JOIN resume_skill_title AS rst ON rs.RESUME_SKILL_TITLE_id = rst.id 
                            WHERE MEMBER_id = ?", array($member));

                        foreach ($donneesSQL as $value) {
                            $skills[$value['id']]['category'] = $value['category'];
                            $skills[$value['id']]['skill'] = $value['skill'];
                            $skills[$value['id']]['active'] = 0;
                        }

                        $donneesSQL = NULL;

                        $donneesSQL = select($connection, "SELECT ra.id, ra.name AS activitie, rat.name AS category 
                            FROM resume_activities AS ra
                            LEFT JOIN resume_activities_title AS rat ON ra.RESUME_ACTIVITIES_TITLE_id = rat.id
                            WHERE MEMBER_id = ?", array($member));

                        foreach ($donneesSQL as $value) {
                            $activities[$value['id']]['category'] = $value['category'];
                            $activities[$value['id']]['activitie'] = $value['activitie'];
                            $activities[$value['id']]['active'] = 0;
                        }

                        $donneesSQL = NULL;

                        $resumeWEOld = array();
                        $donneesSQL = select($connection, "SELECT RESUME_WORK_EXPERIENCE_id AS id FROM resume_has_resume_work_experience WHERE RESUME_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $workExperiences[$value['id']]['active'] = 1;
                            array_push($resumeWEOld, $value['id']);
                        }

                        $donneesSQL = NULL;
                        $resumeWEOld = implode(", ", $resumeWEOld);

                        $resumeEducationOld = array();
                        $donneesSQL = select($connection, "SELECT RESUME_EDUCATION_id AS id FROM resume_has_resume_education WHERE RESUME_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $educations[$value['id']]['active'] = 1;
                            array_push($resumeEducationOld, $value['id']);
                        }

                        $donneesSQL = NULL;
                        $resumeEducationOld = implode(", ", $resumeEducationOld);

                        $resumeSkillsOld = array();
                        $donneesSQL = select($connection, "SELECT RESUME_SKILL_id AS id FROM resume_has_resume_skill WHERE RESUME_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $skills[$value['id']]['active'] = 1;
                            array_push($resumeSkillsOld, $value['id']);
                        }

                        $donneesSQL = NULL;
                        $resumeSkillsOld = implode(", ", $resumeSkillsOld);

                        $resumeActivitiesOld = array();
                        $donneesSQL = select($connection, "SELECT RESUME_ACTIVITIES_id AS id FROM resume_has_resume_activities WHERE RESUME_id = ?", array($id));

                        foreach ($donneesSQL as $value) {
                            $activities[$value['id']]['active'] = 1;
                            array_push($resumeActivitiesOld, $value['id']);
                        }

                        $donneesSQL = NULL;
                        $resumeActivitiesOld = implode(", ", $resumeActivitiesOld);
                        break;
                    case 'modifiedPart':
                        break;
                    case 'modified':
                    default:
                        $donneesSQL = select($connection, "SELECT r.id, r.name,r.enabled, m.firstName, m.lastName FROM resume AS r LEFT JOIN member AS m ON m.id = r.MEMBER_id");


                        foreach ($donneesSQL as $value) {
                            $resumes[$value['id']]['member'] = mb_ucfirst($value['firstName']) . ' ' . mb_strtoupper($value['lastName']);
                            $resumes[$value['id']]['name'] = $value['name'];
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
                        $resumeWEAdd = array_diff($resumeWE, $resumeWEOld);

                        if (!empty($resumeWEAdd)) {
                            $resumeWEAddDB = array();
                            foreach ($resumeWEAdd as $value) {
                                array_push($resumeWEAddDB, array($value, $id));
                            }
                            $resumeWEAdd = NULL;
                        }

                        $resumeWEDelete = array_diff($resumeWEOld, $resumeWE);

                        if (!empty($resumeWEDelete)) {
                            $resumeWEDeleteDB = array();
                            foreach ($resumeWEDelete as $value) {
                                array_push($resumeWEDeleteDB, array($value, $id));
                            }
                            $resumeWEDelete = NULL;
                        }



                        $resumeEducationAdd = array_diff($resumeEducation, $resumeEducationOld);

                        if (!empty($resumeEducationAdd)) {
                            $resumeEducationAddDB = array();
                            foreach ($resumeEducationAdd as $value) {
                                array_push($resumeEducationAddDB, array($value, $id));
                            }
                            $resumeEducationAdd = NULL;
                        }

                        $resumeEducationDelete = array_diff($resumeEducationOld, $resumeEducation);

                        if (!empty($resumeEducationDelete)) {
                            $resumeEducationDeleteDB = array();
                            foreach ($resumeEducationDelete as $value) {
                                array_push($resumeEducationDeleteDB, array($value, $id));
                            }
                            $resumeEducationDelete = NULL;
                        }



                        $resumeSkillsAdd = array_diff($resumeSkills, $resumeSkillsOld);

                        if (!empty($resumeSkillsAdd)) {
                            $resumeSkillsAddDB = array();
                            foreach ($resumeSkillsAdd as $value) {
                                array_push($resumeSkillsAddDB, array($value, $id));
                            }
                            $resumeSkillsAdd = NULL;
                        }

                        $resumeSkillsDelete = array_diff($resumeSkillsOld, $resumeSkills);

                        if (!empty($resumeSkillsDelete)) {
                            $resumeSkillsDeleteDB = array();
                            foreach ($resumeSkillsDelete as $value) {
                                array_push($resumeSkillsDeleteDB, array($value, $id));
                            }
                            $resumeSkillsDelete = NULL;
                        }



                        $resumeActivitiesAdd = array_diff($resumeActivities, $resumeActivitiesOld);

                        if (!empty($resumeActivitiesAdd)) {
                            $resumeActivitiesAddDB = array();
                            foreach ($resumeActivitiesAdd as $value) {
                                array_push($resumeActivitiesAddDB, array($value, $id));
                            }
                            $resumeActivitiesAdd = NULL;
                        }

                        $resumeActivitiesDelete = array_diff($resumeActivitiesOld, $resumeActivities);

                        if (!empty($resumeActivitiesDelete)) {
                            $resumeActivitiesDeleteDB = array();
                            foreach ($resumeActivitiesDelete as $value) {
                                array_push($resumeActivitiesDeleteDB, array($value, $id));
                            }
                            $resumeActivitiesDelete = NULL;
                        }
                        $queryOK = insertUpdate($connection, "UPDATE resume SET ADRESS_id=?, EMAIL_ADRESS_id=?, LANDLINE_PHONE_id=?, MOBILE_PHONE_id=? WHERE id=?", array(array($adress, $email, $landline, $mobile, $id)));

                        if (isset($resumeWEAddDB)) {
                            $queryOK = insertUpdate($connection, "INSERT INTO resume_has_resume_work_experience (RESUME_WORK_EXPERIENCE_id, RESUME_id) VALUES (?,?)", $resumeWEAddDB);
                        }
                        if (isset($resumeWEDeleteDB)) {
                            $queryOK = insertUpdate($connection, "DELETE FROM resume_has_resume_work_experience WHERE RESUME_WORK_EXPERIENCE_id=? AND RESUME_id=?", $resumeWEDeleteDB);
                        }

                        if (isset($resumeEducationAddDB)) {
                            $queryOK = insertUpdate($connection, "INSERT INTO resume_has_resume_education (RESUME_EDUCATION_id, RESUME_id) VALUES (?,?)", $resumeEducationAddDB);
                        }
                        if (isset($resumeEducationDelete)) {
                            $queryOK = insertUpdate($connection, "DELETE FROM resume_has_resume_education WHERE RESUME_EDUCATION_id=? AND RESUME_id=?", $resumeEducationDelete);
                        }

                        if (isset($resumeSkillsAddDB)) {
                            $queryOK = insertUpdate($connection, "INSERT INTO resume_has_resume_skill (RESUME_SKILL_id, RESUME_id) VALUES (?,?)", $resumeSkillsAddDB);
                        }
                        if (isset($resumeSkillsDelete)) {
                            $queryOK = insertUpdate($connection, "DELETE FROM resume_has_resume_skill WHERE RESUME_SKILL_id=? AND RESUME_id=?", $resumeSkillsDelete);
                        }

                        if (isset($resumeActivitiesAddDB)) {
                            $queryOK = insertUpdate($connection, "INSERT INTO resume_has_resume_activities (RESUME_ACTIVITIES_id, RESUME_id) VALUES (?,?)", $resumeActivitiesAddDB);
                        }
                        if (isset($resumeActivitiesDelete)) {
                            $queryOK = insertUpdate($connection, "DELETE FROM resume_has_resume_activities WHERE RESUME_ACTIVITIES_id=? AND RESUME_id=?", $resumeActivitiesDelete);
                        }

                        $action = 'listing';
                        $moduleAction = NULL;
                        $moduleAction[0] = 'dbVars';
                        $moduleAction[1] = 'listView';
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
                    $action = 'listing';
                    $moduleAction = NULL;
                    $moduleAction[0] = 'dbVars';
                    $moduleAction[1] = 'listView';
                } else {

                    $resumeWEAdd = array_diff($resumeWE, $resumeWEOld);

                    if (!empty($resumeWEAdd)) {
                        $resumeWEAddDB = array();
                        foreach ($resumeWEAdd as $value) {
                            array_push($resumeWEAddDB, array($value, $id));
                        }
                        $resumeWEAdd = NULL;
                    }

                    $resumeWEDelete = array_diff($resumeWEOld, $resumeWE);

                    if (!empty($resumeWEDelete)) {
                        $resumeWEDeleteDB = array();
                        foreach ($resumeWEDelete as $value) {
                            array_push($resumeWEDeleteDB, array($value, $id));
                        }
                        $resumeWEDelete = NULL;
                    }



                    $resumeEducationAdd = array_diff($resumeEducation, $resumeEducationOld);

                    if (!empty($resumeEducationAdd)) {
                        $resumeEducationAddDB = array();
                        foreach ($resumeEducationAdd as $value) {
                            array_push($resumeEducationAddDB, array($value, $id));
                        }
                        $resumeEducationAdd = NULL;
                    }

                    $resumeEducationDelete = array_diff($resumeEducationOld, $resumeEducation);

                    if (!empty($resumeEducationDelete)) {
                        $resumeEducationDeleteDB = array();
                        foreach ($resumeEducationDelete as $value) {
                            array_push($resumeEducationDeleteDB, array($value, $id));
                        }
                        $resumeEducationDelete = NULL;
                    }



                    $resumeSkillsAdd = array_diff($resumeSkills, $resumeSkillsOld);

                    if (!empty($resumeSkillsAdd)) {
                        $resumeSkillsAddDB = array();
                        foreach ($resumeSkillsAdd as $value) {
                            array_push($resumeSkillsAddDB, array($value, $id));
                        }
                        $resumeSkillsAdd = NULL;
                    }

                    $resumeSkillsDelete = array_diff($resumeSkillsOld, $resumeSkills);

                    if (!empty($resumeSkillsDelete)) {
                        $resumeSkillsDeleteDB = array();
                        foreach ($resumeSkillsDelete as $value) {
                            array_push($resumeSkillsDeleteDB, array($value, $id));
                        }
                        $resumeSkillsDelete = NULL;
                    }



                    $resumeActivitiesAdd = array_diff($resumeActivities, $resumeActivitiesOld);

                    if (!empty($resumeActivitiesAdd)) {
                        $resumeActivitiesAddDB = array();
                        foreach ($resumeActivitiesAdd as $value) {
                            array_push($resumeActivitiesAddDB, array($value, $id));
                        }
                        $resumeActivitiesAdd = NULL;
                    }

                    $resumeActivitiesDelete = array_diff($resumeActivitiesOld, $resumeActivities);

                    if (!empty($resumeActivitiesDelete)) {
                        $resumeActivitiesDeleteDB = array();
                        foreach ($resumeActivitiesDelete as $value) {
                            array_push($resumeActivitiesDeleteDB, array($value, $id));
                        }
                        $resumeActivitiesDelete = NULL;
                    }

                    $queryOK = insertUpdate($connection, "UPDATE resume SET MEMBER_id=?, name=?, enabled=?, telework=?, ADRESS_id=?, EMAIL_ADRESS_id=?, MOBILE_PHONE_id=?, LANDLINE_PHONE_id=?, annualRemunerationStart=?, annualRemunerationEnd=? WHERE id=?", array(array($member, $name, $enabled, $telework, $adress, $email, $mobile, $landline, $annualRemunerationStart, $annualRemunerationEnd, $id)));

                    if (isset($resumeWEAddDB)) {
                        $queryOK = insertUpdate($connection, "INSERT INTO resume_has_resume_work_experience (RESUME_WORK_EXPERIENCE_id, RESUME_id) VALUES (?,?)", $resumeWEAddDB);
                    }
                    if (isset($resumeWEDeleteDB)) {
                        $queryOK = insertUpdate($connection, "DELETE FROM resume_has_resume_work_experience WHERE RESUME_WORK_EXPERIENCE_id=? AND RESUME_id=?", $resumeWEDeleteDB);
                    }

                    if (isset($resumeEducationAddDB)) {
                        $queryOK = insertUpdate($connection, "INSERT INTO resume_has_resume_education (RESUME_EDUCATION_id, RESUME_id) VALUES (?,?)", $resumeEducationAddDB);
                    }
                    if (isset($resumeEducationDelete)) {
                        $queryOK = insertUpdate($connection, "DELETE FROM resume_has_resume_education WHERE RESUME_EDUCATION_id=? AND RESUME_id=?", $resumeEducationDelete);
                    }

                    if (isset($resumeSkillsAddDB)) {
                        $queryOK = insertUpdate($connection, "INSERT INTO resume_has_resume_skill (RESUME_SKILL_id, RESUME_id) VALUES (?,?)", $resumeSkillsAddDB);
                    }
                    if (isset($resumeSkillsDelete)) {
                        $queryOK = insertUpdate($connection, "DELETE FROM resume_has_resume_skill WHERE RESUME_SKILL_id=? AND RESUME_id=?", $resumeSkillsDelete);
                    }

                    if (isset($resumeActivitiesAddDB)) {
                        $queryOK = insertUpdate($connection, "INSERT INTO resume_has_resume_activities (RESUME_ACTIVITIES_id, RESUME_id) VALUES (?,?)", $resumeActivitiesAddDB);
                    }
                    if (isset($resumeActivitiesDelete)) {
                        $queryOK = insertUpdate($connection, "DELETE FROM resume_has_resume_activities WHERE RESUME_ACTIVITIES_id=? AND RESUME_id=?", $resumeActivitiesDelete);
                    }
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
                $action = 'addedStep';
                $contentView = 'modules/resumes/view_add.php';
                break;
            case 'nextView':
                $actionDisplay = "Ajouter";
                $contentView = 'modules/resumes/view_add_' . $nextStep . '.php';
                break;
            case 'modifyView':
                $actionDisplay = "Modifier";
                $action = 'modified';
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