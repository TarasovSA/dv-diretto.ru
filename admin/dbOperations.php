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
}
catch(PDOException $e) {
    errorMessageHandler($e);
}

function dbGetCoefficientsForCalc($structure)
{
    //TODO: need to convert to temp DB
    global $DBH;
    $coefficients = array();
    try {
        $STH = $DBH->prepare("SELECT * FROM coefficient WHERE calc = :calc");
        $STH->execute($structure);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $STH->fetch()) {
            $temp['id'] = $row['id'];
            $temp['name'] = $row['name'];
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