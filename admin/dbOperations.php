<?php

$dbHost = 'paboti.mysql';
$dbName = 'paboti_dvdiretto';
$dbUser = 'paboti_mysql';
$dbPass = 'mnsjmlnn';

function errorMessageHandler ($e)
{
    echo $e->getMessage();
}
//connect to DB
try {
    # MySQL через PDO_MYSQL
    $DBH = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

    $DBH->exec("SET NAMES 'utf8'");
    $DBH->exec("SET collation_connection = 'utf8_general_ci'");
    $DBH->exec("SET collation_server = 'utf8_general_ci'");
    $DBH->exec("SET character_set_client = 'utf8'");
    $DBH->exec("SET character_set_connection = 'utf8'");
    $DBH->exec("SET character_set_results = 'utf8'");
    $DBH->exec("SET character_set_server = 'utf8'");
}
catch(PDOException $e) {
    errorMessageHandler($e);
}

function dbGetCoefficientsForCalc($structure)
{
    global $DBH;
    $coefficients = array();
    try {
        $STH = $DBH->prepare("SELECT * FROM coefficient WHERE calc = :calc ORDER BY name ASC");
        $STH->execute($structure);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $STH->fetch()) {
            $temp['id'] = $row['id'];
            $temp['name'] = $row['name'];
            $temp['param'] = $row['param'];
            $temp['longName'] = $row['longName'];
            $temp['calc'] = $row['calc'];
            $temp['value'] = $row['value'];
            array_push($coefficients, $temp);
        }
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    return $coefficients;
}

function dbUpdateCoefficient($structure)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("UPDATE coefficient SET value = :value WHERE id = :id");
        $STH->execute($structure);
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    return 1;
}