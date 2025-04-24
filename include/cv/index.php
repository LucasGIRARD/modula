<?php

function encode_email($e) {
    $output = "";
    for ($i = 0; $i < strlen($e); $i++) {
        $output .= '&#' . ord($e[$i]) . ';';
    }
    return $output;
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'cv';
}
$idMember = 1;
$connection = openSQLConnexion();
switch ($page) {
    case "fullCivilState":
        $donneesSQL = select($connection, "SELECT email, firstName, lastName, maritalStatus, DATE_FORMAT(birthday,'%d/%m/%Y') AS birthday, adress, country, town, cp, vcard, ldif, studiesLevel, telework, remuneration, mp.number AS 'mobilePhone', lp.number AS 'landlinePhone' FROM member AS m LEFT JOIN personal_details AS pd ON ( pd.id = PERSONAL_DETAILS_id ) LEFT JOIN localisation AS l ON ( l.id = LOCALISATION_id ) LEFT JOIN resume AS r ON ( r.id = RESUME_id ) LEFT JOIN phone AS lp ON ( m.id = lp.MEMBER_id && lp.PHONE_TYPE_id =1 ) LEFT JOIN phone AS mp ON ( m.id = mp.MEMBER_id && mp.PHONE_TYPE_id =2 ) WHERE m.id =?", array($idMember));
        $firstName = $donneesSQL[0]['firstName'];
        $lastName = $donneesSQL[0]['lastName'];
        $age = $donneesSQL[0]['birthday'];
        $maritalStatus = $donneesSQL[0]['maritalStatus'];
        $adress = $donneesSQL[0]['adress'];
        $town = $donneesSQL[0]['town'];
        $cp = $donneesSQL[0]['cp'];
        $country = $donneesSQL[0]['country'];
        $email = encode_email($donneesSQL[0]['email']);
        $studiesLevel = $donneesSQL[0]['studiesLevel'];
        $telework = $donneesSQL[0]['telework'];
        $remuneration = $donneesSQL[0]['remuneration'];
        $landlinePhone = $donneesSQL[0]['landlinePhone'];
        $mobilePhone = $donneesSQL[0]['mobilePhone'];

        $donneesSQL = select($connection, "SELECT name FROM member AS m LEFT JOIN `driving_license-member` AS dlm ON (dlm.MEMBER_id = m.id) LEFT JOIN driving_license AS dl ON (dlm.DRIVING_LICENSE_id = dl.id) WHERE m.id =?", array($idMember));
        $drivingLicense = "";
        foreach ($donneesSQL as $donnees) {
            $drivingLicense .= $donneesSQL[0]['name'];
        }

        $donneesSQL = select($connection, "SELECT name FROM member AS m LEFT JOIN `member-vehicle` AS mv ON (mv.MEMBER_id = m.id) LEFT JOIN vehicle AS v ON (mv.VEHICLE_id = v.id) WHERE m.id =?", array($idMember));
        $vehicle = "";
        foreach ($donneesSQL as $donnees) {
            $vehicle .= $donneesSQL[0]['name'];
        }
        $donneesSQL = null;
        break;
    case "civilState":
        $donneesSQL = select($connection, "SELECT email, firstName, lastName, maritalStatus, DATE_FORMAT(birthday,'%d/%m/%Y') AS birthday, adress, town, cp, vcard, ldif, studiesLevel, mp.number AS 'mobilePhone', lp.number AS 'landlinePhone' FROM member AS m LEFT JOIN personal_details AS pd ON ( pd.id = PERSONAL_DETAILS_id ) LEFT JOIN localisation AS l ON ( l.id = LOCALISATION_id ) LEFT JOIN resume AS r ON ( r.id = RESUME_id ) LEFT JOIN phone AS lp ON ( m.id = lp.MEMBER_id && lp.PHONE_TYPE_id =1 ) LEFT JOIN phone AS mp ON ( m.id = mp.MEMBER_id && mp.PHONE_TYPE_id =2 ) WHERE m.id =?", array($idMember));
        $firstName = $donneesSQL[0]['firstName'];
        $lastName = $donneesSQL[0]['lastName'];
        $age = $donneesSQL[0]['birthday'];
        $maritalStatus = $donneesSQL[0]['maritalStatus'];
        $adress = $donneesSQL[0]['adress'];
        $town = $donneesSQL[0]['town'];
        $cp = $donneesSQL[0]['cp'];
        $email = encode_email($donneesSQL[0]['email']);
        $studiesLevel = $donneesSQL[0]['studiesLevel'];
        $landlinePhone = $donneesSQL[0]['landlinePhone'];
        $mobilePhone = $donneesSQL[0]['mobilePhone'];

        $donneesSQL = select($connection, "SELECT name FROM member AS m LEFT JOIN `driving_license-member` AS dlm ON (dlm.MEMBER_id = m.id) LEFT JOIN driving_license AS dl ON (dlm.DRIVING_LICENSE_id = dl.id) WHERE m.id =?", array($idMember));
        $drivingLicense = "";
        foreach ($donneesSQL as $donnees) {
            $drivingLicense .= $donneesSQL[0]['name'];
        }

        $donneesSQL = select($connection, "SELECT name FROM member AS m LEFT JOIN `member-vehicle` AS mv ON (mv.MEMBER_id = m.id) LEFT JOIN vehicle AS v ON (mv.VEHICLE_id = v.id) WHERE m.id =?", array($idMember));
        $vehicle = "";
        foreach ($donneesSQL as $donnees) {
            $vehicle .= $donneesSQL[0]['name'];
        }
        $donneesSQL = null;
        break;
    case "workExperience":
        $donneesSQL2 = select($connection, "SELECT rwet.id AS typeId, rwet.name, rwet.description, rwe.id, DATE_FORMAT(startDate,'%M %Y') AS startDates, DATE_FORMAT(endDate,'%M %Y') AS endDate, company, situation, rwes.name AS skill FROM member AS m LEFT JOIN resume AS r ON ( r.id = m.RESUME_id ) LEFT JOIN resume_work_experience_type AS rwet ON ( r.id = rwet.RESUME_id ) LEFT JOIN resume_work_experience AS rwe ON ( rwe.RESUME_WORK_EXPERIENCE_TYPE_id = rwet.id ) LEFT JOIN resume_work_experience_skill AS rwes ON ( rwes.RESUME_WORK_EXPERIENCE_id = rwe.id ) WHERE m.id =?", array($idMember));
        break;
    case "education":
        $donneesSQL3 = select($connection, "SELECT re.startYear, re.endYear, re.name AS degreeName, re.obtained, s.name AS schoolName, s.town, ro.name AS optionName FROM member AS m LEFT JOIN resume AS r ON ( r.id = m.RESUME_id ) LEFT JOIN resume_education AS re ON (re.RESUME_id = r.id) LEFT JOIN school AS s ON (s.id = re.SCHOOL_id) LEFT JOIN `resume_education-resume_option` AS rero ON (rero.RESUME_EDUCATION_id  = re.id) LEFT JOIN resume_option AS ro ON (ro.id = rero.RESUME_OPTION_id) WHERE m.id =?", array($idMember));
        break;
    case "skill":
        $donneesSQL4 = select($connection, "SELECT rst.id, rst.name AS title, rs.name AS skill, rs.level FROM member AS m LEFT JOIN resume AS r ON ( r.id = m.RESUME_id ) LEFT JOIN resume_skill_title AS rst ON (rst.RESUME_id = r.id) LEFT JOIN resume_skill AS rs ON (rs.RESUME_SKILL_TITLE_id = rst.id) WHERE m.id =? ORDER BY rst.number, rs.number", array($idMember));
        break;
    case "activitie":
        $donneesSQL5 = select($connection, "SELECT rat.id, rat.name AS title, ra.name AS activitie FROM member AS m LEFT JOIN resume AS r ON ( r.id = m.RESUME_id ) LEFT JOIN resume_activities_title AS rat ON (rat.RESUME_id = r.id) LEFT JOIN resume_activities AS ra ON (ra.RESUME_ACTIVITIES_TITLE_id = rat.id) WHERE m.id =?", array($idMember));
        break;
    default:
        $donneesSQL = select($connection, "SELECT email, firstName, lastName, maritalStatus, DATE_FORMAT(birthday,'%d/%m/%Y') AS birthday, adress, town, cp, vcard, ldif, studiesLevel, mp.number AS 'mobilePhone', lp.number AS 'landlinePhone' FROM member AS m LEFT JOIN personal_details AS pd ON ( pd.id = PERSONAL_DETAILS_id ) LEFT JOIN localisation AS l ON ( l.id = LOCALISATION_id ) LEFT JOIN resume AS r ON ( r.id = RESUME_id ) LEFT JOIN phone AS lp ON ( m.id = lp.MEMBER_id && lp.PHONE_TYPE_id =1 ) LEFT JOIN phone AS mp ON ( m.id = mp.MEMBER_id && mp.PHONE_TYPE_id =2 ) WHERE m.id =?", array($idMember));
        $firstName = $donneesSQL[0]['firstName'];
        $lastName = $donneesSQL[0]['lastName'];
        $age = $donneesSQL[0]['birthday'];
        $maritalStatus = $donneesSQL[0]['maritalStatus'];
        $adress = $donneesSQL[0]['adress'];
        $town = $donneesSQL[0]['town'];
        $cp = $donneesSQL[0]['cp'];
        $email = encode_email($donneesSQL[0]['email']);
        $studiesLevel = $donneesSQL[0]['studiesLevel'];
        $landlinePhone = $donneesSQL[0]['landlinePhone'];
        $mobilePhone = $donneesSQL[0]['mobilePhone'];

        $donneesSQL = select($connection, "SELECT name FROM member AS m LEFT JOIN `driving_license-member` AS dlm ON (dlm.MEMBER_id = m.id) LEFT JOIN driving_license AS dl ON (dlm.DRIVING_LICENSE_id = dl.id) WHERE m.id =?", array($idMember));
        $drivingLicense = "";
        foreach ($donneesSQL as $donnees) {
            $drivingLicense .= $donneesSQL[0]['name'];
        }

        $donneesSQL = select($connection, "SELECT name FROM member AS m LEFT JOIN `member-vehicle` AS mv ON (mv.MEMBER_id = m.id) LEFT JOIN vehicle AS v ON (mv.VEHICLE_id = v.id) WHERE m.id =?", array($idMember));
        $vehicle = "";
        foreach ($donneesSQL as $donnees) {
            $vehicle .= $donneesSQL[0]['name'];
        }
        $donneesSQL = null;
        
        $donneesSQL2 = select($connection, "SELECT rwet.id AS typeId, rwet.name, rwet.description, rwe.id, DATE_FORMAT(startDate,'%M %Y') AS startDates, DATE_FORMAT(endDate,'%M %Y') AS endDate, company, situation, rwes.name AS skill FROM member AS m LEFT JOIN resume AS r ON ( r.id = m.RESUME_id ) LEFT JOIN resume_work_experience_type AS rwet ON ( r.id = rwet.RESUME_id ) LEFT JOIN resume_work_experience AS rwe ON ( rwe.RESUME_WORK_EXPERIENCE_TYPE_id = rwet.id ) LEFT JOIN resume_work_experience_skill AS rwes ON ( rwes.RESUME_WORK_EXPERIENCE_id = rwe.id ) WHERE m.id =?", array($idMember));
        $donneesSQL3 = select($connection, "SELECT re.startYear, re.endYear, re.name AS degreeName, re.obtained, s.name AS schoolName, s.town, ro.name AS optionName FROM member AS m LEFT JOIN resume AS r ON ( r.id = m.RESUME_id ) LEFT JOIN resume_education AS re ON (re.RESUME_id = r.id) LEFT JOIN school AS s ON (s.id = re.SCHOOL_id) LEFT JOIN `resume_education-resume_option` AS rero ON (rero.RESUME_EDUCATION_id  = re.id) LEFT JOIN resume_option AS ro ON (ro.id = rero.RESUME_OPTION_id) WHERE m.id =?", array($idMember));
        $donneesSQL4 = select($connection, "SELECT rst.id, rst.name AS title, rs.name AS skill, rs.level FROM member AS m LEFT JOIN resume AS r ON ( r.id = m.RESUME_id ) LEFT JOIN resume_skill_title AS rst ON (rst.RESUME_id = r.id) LEFT JOIN resume_skill AS rs ON (rs.RESUME_SKILL_TITLE_id = rst.id) WHERE m.id =? ORDER BY rst.number, rs.number", array($idMember));
        $donneesSQL5 = select($connection, "SELECT rat.id, rat.name AS title, ra.name AS activitie FROM member AS m LEFT JOIN resume AS r ON ( r.id = m.RESUME_id ) LEFT JOIN resume_activities_title AS rat ON (rat.RESUME_id = r.id) LEFT JOIN resume_activities AS ra ON (ra.RESUME_ACTIVITIES_TITLE_id = rat.id) WHERE m.id =?", array($idMember));
        break;
}
closeSQLConnexion($connection);
?>
<nav id="submenu">
    <ul>
        <li><a href="index.php?module=cv">tout le cv</a></li>
        <li><a href="index.php?module=cv&amp;page=fullCivilState">état civil</a></li>
        <li><a href="index.php?module=cv&amp;page=workExperience">expériences professionnelles</a></li>
        <li><a href="index.php?module=cv&amp;page=education">formations</a></li>
        <li><a href="index.php?module=cv&amp;page=skill">compétences techniques</a></li>
        <li><a href="index.php?module=cv&amp;page=activitie">centres d'intérêts</a></li>
    </ul>
</nav>
<br />
<?php
include 'include/cv/view.php';
?>
