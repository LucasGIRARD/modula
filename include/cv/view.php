<?php
switch ($page) {
    case "fullCivilState":
    case "civilState":
        include 'include/cv/civilState.php';
        break;
    case "education":
        include 'include/cv/education.php';
        break;
    case "skill":
        include 'include/cv/skill.php';
        break;
    case "workExperience":
        include 'include/cv/workExperience.php';
        break;
    case "activitie":
        include 'include/cv/activitie.php';
        break;
    default:
        include 'include/cv/civilState.php';
        include 'include/cv/workExperience.php';
        include 'include/cv/education.php';
        include 'include/cv/skill.php';        
        include 'include/cv/activitie.php';
        break;
}
?>