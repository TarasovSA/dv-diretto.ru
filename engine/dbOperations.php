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


/*function dbGetCarsList()
{
    global $DBH;
    $carsList = array();
    try {
        $STH = $DBH->prepare('SELECT * FROM cars WHERE 1');
        $STH->execute();
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch())
        {
            $carsList[$row['type']][$row['model']]['yearStart'] = $row['yearStart'];
            $carsList[$row['type']][$row['model']]['yearStop'] = $row['yearStop'];
            $carsList[$row['type']][$row['model']]['damage'] = $row['damage'];
            $carsList[$row['type']][$row['model']]['theft'] = $row['theft'];
            $carsList[$row['type']][$row['model']]['minCost'] = $row['minCost'];
            $carsList[$row['type']][$row['model']]['maxCost'] = $row['maxCost'];
            $carsList[$row['type']][$row['model']]['defaultCost'] = $row['defaultCost'];
        }
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }

    foreach ($carsList as $type=>$carModels)
    {
        $STH = $DBH->prepare("INSERT INTO carsTypes (typeName) VALUES (:typeName)");
        $STH->execute(array('typeName'=>$type));
        $idType = $DBH->lastInsertId();
        foreach ($carModels as $model=>$car)
        {
            $STH = $DBH->prepare("INSERT INTO carsModels (idType, modelName) VALUES (:idType, :modelName)");
            $STH->execute(array('idType' => $idType, 'modelName'=>$model));
            $idModel = $DBH->lastInsertId();

            $STH = $DBH->prepare("INSERT INTO carsParams (idModel, yearStart, yearStop, damage, theft, minCost, maxCost, defaultCost) VALUES (:idModel, :yearStart, :yearStop, :damage, :theft, :minCost, :maxCost, :defaultCost)");
            $STH->execute(array('idModel' => $idModel, 'yearStart' => '2000-01-01', 'yearStop' => '2012-12-31', 'damage' => $car['damage'], 'theft' => $car['damage'], 'minCost' => $car['minCost'], 'maxCost' => $car['maxCost'], 'defaultCost' => $car['defaultCost']));
        }
    }

    return $carsList;
}*/

function dbGetCar($structure)
{
    global $DBH;
    $carsList = array();
    try {
        $STH = $DBH->prepare('SELECT carsMarks.id as idMark, carsModels.id as idModel, markName, modelName, carsModifications.id as carModificationId, year, cost FROM carsMarks LEFT JOIN carsModels ON carsMarks.id = carsModels.idMark LEFT JOIN carsModifications ON carsModels.id = carsModifications.idModel WHERE carsMarks.id = :carMarkId AND carsModels.id = :carModelId');
        $STH->execute($structure);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $carsList[$row['idMark']]['name'] = $row['markName'];
            $carsList[$row['idMark']][$row['idModel']]['name'] = $row['modelName'];
            $temp['yearStart'] = $row['year'];
            //$temp['damage'] = $row['damage'];
            //$temp['theft'] = $row['theft'];
            $temp['defaultCost'] = $row['cost'];
            $carsList[$row['idMark']][$row['idModel']][] = $temp;
        }

    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    return $carsList;
}

function dbGetCarsMarks()
{
    global $DBH;
    $carsTypesList = array();
    try {
        $STH = $DBH->prepare('SELECT * FROM carsMarks WHERE 1 ORDER BY `markName`');
        $STH->execute();
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $carsTypesList[$row['id']] = $row['markName'];
        }

    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    return $carsTypesList;
}

function dbGetCarsModelsByMark($structure)
{
    global $DBH;
    $carsModelList = array();
    try {
        $STH = $DBH->prepare('SELECT id, modelName FROM carsModels WHERE carsModels.idMark = :idMark');
        $STH->execute($structure);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $carsModelList[$row['id']] = $row['modelName'];
        }
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    return $carsModelList;
}

function dbGetCarsModificationsByModel($structure)
{
    global $DBH;
    $carsParamsList = array();
    try {
        $STH = $DBH->prepare('SELECT id, modificationName, cost FROM carsModifications WHERE carsModifications.idModel = :idModel AND carsModifications.year = :year');
        $STH->execute($structure);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $carsParamsList[$row['id']]['modificationName'] = $row['modificationName'];
            $carsParamsList[$row['id']]['cost'] = $row['cost'];
        }

    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }
    return $carsParamsList;
}