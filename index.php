<?php
ini_set('arg_separator.output', '&amp;');
session_start();

include_once 'include/SQL.php';
include 'model.php';

if (isset($_POST['action'])) {
    $module = "work";
} else {
    if (isset($_GET['module'])) {
        $module = getModule($_GET['module']);
    } else {
        $module = "page";
        if (isset($_GET['page'])) {
            $page = getPage($_GET['page']);
        } else {
            $page = "home";
        }
    }
}

$content = "include/$module/index.php";

include 'theme/default/index.php';
?>