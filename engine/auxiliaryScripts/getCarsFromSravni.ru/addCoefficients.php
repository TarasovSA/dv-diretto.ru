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

$fp = fopen('coefficients.csv', 'r');
while ($col = fgetcsv($fp, null, ';'))
{
    try
    {
        $STH = $DBH->prepare("SELECT id FROM `carsMarks` WHERE markName = :markName");
        $STH->execute(array('markName' => $col[0]));
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $rowQuantity = $STH->rowCount();
        if ($rowQuantity > 0)
        {
            $row = $STH->fetch();
            $id = $row['id'];
            echo $col[0]." = ".$id."</br>";


            try
            {
                $STH = $DBH->prepare("UPDATE carsModels SET damage = :damage, theft = :theft WHERE idMark = :idMark AND modelName = :modelName");
                $my = array('damage' => str_replace(',', '.', $col[2]), 'theft' => str_replace(',', '.', $col[3]), 'idMark' => $id, 'modelName' => $col[1]);
                print_r ($my);
                $STH->execute($my);
            }
            catch (PDOException $e)
            {
                errorMessageHandler($e);
            }


        }
        else
            $id = 0;

    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
}