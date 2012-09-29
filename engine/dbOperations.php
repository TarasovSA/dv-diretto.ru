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

function dbAddTempVillaggio($struct)
{
    //TODO: need to convert to temp DB
    global $DBH;
    try {
        $STH = $DBH->prepare("SELECT id FROM _temp_villaggion WHERE sessionId = :sessionId");
        $STH->execute($struct['sessionId']);
        $rowQuantity = $STH->rowCount();
        if ($rowQuantity == 0)
        {
            $STH = $DBH->prepare("INSERT INTO _temp_villaggio (sessionId, constructionEl, isExteriorTrim, exteriorTrim, isInteriorTrim, interiorTrim, isEngineeringSystems, engineeringSystems, isProperty, property, isLiability, liability, added) VALUES (:sessionId, :constructionEl, :isExteriorTrim, :exteriorTrim, :isInteriorTrim, :interiorTrim, :isEngineeringSystems, :engineeringSystems, :isProperty, :property, :isLiability, :liability, :added)");
            $STH->execute($struct);
        }
        else
        {
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $row = $STH->fetch();
            $STH = $DBH->prepare("UPDATE _temp_villaggion SET sessionId = :sessionId, constructionEl = :constructionEl, isExteriorTrim = :isExteriorTrim, exteriorTrim = :exteriorTrim, isInteriorTrim = :isInteriorTrim, interiorTrim = :interiorTrim, isEngineeringSystems = :isEngineeringSystems, engineeringSystems = :engineeringSystems, isProperty = :isProperty, property = :property, isLiability = :isLiability, liability = :liability, added = :added");
            $STH->execute($struct);
        }

    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
}

function dbAddVillaggio($struct)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("INSERT INTO villaggio (idUser, constructionEl, isExteriorTrim, exteriorTrim, isInteriorTrim, interiorTrim, isEngineeringSystems, engineeringSystems, isProperty, property, isLiability, liability, state, active, added, startsFrom, nextPayDay, runsUntil) VALUES (:idUser, :constructionEl, :isExteriorTrim, :exteriorTrim, :isInteriorTrim, :interiorTrim, :isEngineeringSystems, :engineeringSystems, :isProperty, :property, :isLiability, :liability, :state, :active, :added, :startsFrom, :nextPayDay, :runsUntil)");
        $STH->execute($struct);
        $idVillaggio = $DBH->lastInsertId();
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    return $idVillaggio;
}

function dbAddNewUser($structure)
{
    global $DBH;
    $idUser = 0;
    try {
        $STH = $DBH->prepare("SELECT id FROM user WHERE login = :login");
        $STH->execute(array('login' => $structure['login']));
        $rowQuantity = $STH->rowCount();
        if ($rowQuantity == 0)
        {
            $STH = $DBH->prepare("INSERT INTO user (name, login, password, email, salt, region, city, street, house, housing, apartment, passportSeries, passportNumber, birthday, phone) VALUES (:name, :login, :password, :email, :salt, :region, :city, :street, :house, :housing, :apartment, :passportSeries, :passportNumber, :birthday, :phone)");
            $STH->execute($structure);
            $idUser = $DBH->lastInsertId();
        }
        else
        {
            $idUser = 0;
        }
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    return $idUser;
}

function dbGetUser($id)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("SELECT * FROM user WHERE id = :id");
        $STH->execute(array('id'=>$id));
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $STH->fetch()) {
            echo $row['name'] . "\n";
            echo $row['phone'] . "\n";
            echo $row['city'] . "\n";
        }
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    //return $idUser;
}

function dbGetUserId($structure)
{
    global $DBH;
    $idUser = 0;
    try {
        $STH = $DBH->prepare("SELECT id, password, salt FROM user WHERE login = :login");
        $STH->execute(array('login'=>$structure['login']));
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $rowQuantity = $STH->rowCount();
        if ($rowQuantity > 0)
        {
            $row = $STH->fetch();
            $userSalt = $row['salt'];
            $userPassword = $row['password'];
            if ($userPassword == md5(md5($structure['password']).md5($userSalt)))
                $idUser = $row['id'];
        }
        else
            $idUser = 0;
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }

    return $idUser;
}