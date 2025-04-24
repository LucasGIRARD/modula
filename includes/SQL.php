<?php

function openSQLConnexion() {
    $host = 'mysql:host=localhost;dbname=creative';
    $user = 'root';
    $password = '';
    $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    try {
        $connection = new PDO($host, $user, $password, $option);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $connection;
}

function closeSQLConnexion($connection) {
    $connection = null;
}

function insertUpdate($connection, $query, $tabVars) {
    try {
        $resultat = $connection->prepare($query);
        foreach ($tabVars as $vars) {
            $resultat->execute($vars);
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $resultat;
}

function select($connection, $query, $tabVars) {
    $resultat = insertUpdate($connection, $query, $tabVars);
    try {
        return $resultat->fetchAll();
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

function rowNumber($resultat) {
    try {
        return $resultat->rowCount();
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

?>