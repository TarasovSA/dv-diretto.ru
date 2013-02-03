<?php


//$dbHost = 'paboti.mysql';
//$dbName = 'paboti_dvdiretto';
//$dbUser = 'paboti_mysql';
//$dbPass = 'mnsjmlnn';

$dbHost = '127.0.0.1';
$dbName = 'paboti_dvdiretto';
$dbUser = 'root';
$dbPass = '';


function errorMessageHandler ($e)
{
    echo $e->getMessage();
}
//connect to DB
try {
    # MySQL ????? PDO_MYSQL
    $DBH = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser);
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

$modificationsIds = array(2005 => array(),
    2006 => array(),
    2007 => array(),
    2008 => array(),
    2009 => array(),
    2010 => array(),
    2011 => array(),
    2012 => array(),
    2013 => array());

try {
    $STH = $DBH->prepare("SELECT * FROM carsMarks LEFT JOIN carsModels ON carsMarks.idMark = carsModels.idMark WHERE 1");
    $STH->execute();
    $STH->setFetchMode(PDO::FETCH_ASSOC);

    while($row = $STH->fetch()) {
    //for ($i=0; $i<10; $i++){
        echo '<h1>'.$row['markName'].'</h1></br>';
        echo "\n";
        echo 'http://www.sravni.ru/Autocomplete/Model/?term='.urlencode($row['markName'].' '.$row['modelName']).'</br>';
        echo "\n";
        $file = file_get_contents('http://www.sravni.ru/Autocomplete/Model/?term='.urlencode($row['markName'].' '.$row['modelName']));
        $modelId = json_decode($file);
        for ($year=2005; $year<=2013; $year++)
        {
            //echo '-> http://www.sravni.ru/Kasko/Suggest/Modification/?term=&year='.$year.'&modelId='.$modelId->carModel."</br>";
            $file = file_get_contents('http://www.sravni.ru/Kasko/Suggest/Modification/?term=&year='.$year.'&modelId='.$modelId->carModel);
            if ($file == '""')
            {
                updateCarsModelYear($year, $row['idModel']);
                break;
            }
            else
            {
                getModification('', $year, $modelId->carModel, $row['idModel']);
            }
        }
    }
}
catch (PDOException $e)
{
    errorMessageHandler($e);
}

function getModification($term, $year, $modelId, $realId)
{
    global $modificationsIds, $DBH;
    echo '--> http://www.sravni.ru/Kasko/Suggest/Modification/?term='.urlencode($term).'&year='.$year.'&modelId='.$modelId.'</br>';
    echo "\n";
    $file = file_get_contents('http://www.sravni.ru/Kasko/Suggest/Modification/?term='.urlencode($term).'&year='.$year.'&modelId='.$modelId);
    $result = json_decode($file);

    if (isset($result->suggests))
    {
        foreach ($result->suggests as $newTerm)
        {
            getModification($newTerm, $year, $modelId, $realId);
        }
    }
    else
    {
        if (!in_array($result->carModelId, $modificationsIds[$year]))
        {
            $modificationsIds[$year][] = $result->carModelId;
            try {
                $STH = $DBH->prepare("INSERT INTO carsModifications (idModel, modificationName, price, year) VALUES (:idModel, :modificationName, :price, :year)");
                $STH->execute(array('idModel' => $realId, 'modificationName' => $term, 'price' => $result->Info->price, 'year' => $year));
                echo '<h3>'.$term.' - added</h3></br>';
                echo "\n";
            }
            catch (PDOException $e)
            {
                errorMessageHandler($e);
            }
        }
    }
}

function updateCarsModelYear($year, $model)
{
    global $DBH;
    try {
        $STH = $DBH->prepare("UPDATE carsModels SET endYear = :endYear WHERE idModel = :idModel");
        $STH->execute(array('endYear' => ($year-1), 'idModel' => $model));
    }
    catch (PDOException $e)
    {
        errorMessageHandler($e);
    }

}





function post_request($url, $data, $referer='') {

    // Convert the data array into URL Parameters like a=b&foo=bar etc.
    $data = http_build_query($data);

    // parse the given URL
    $url = parse_url($url);

    if ($url['scheme'] != 'http') {
        die('Error: Only HTTP request are supported !');
    }

    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];

    // open a socket connection on port 80 - timeout: 30 sec
    $fp = fsockopen($host, 80, $errno, $errstr, 30);

    if ($fp){

        // send the request headers:
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");

        if ($referer != '')
            fputs($fp, "Referer: $referer\r\n");

        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ". strlen($data) ."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data);

        $result = '';
        while(!feof($fp)) {
            // receive the results of the request
            $result .= fgets($fp, 128);
        }
    }
    else {
        return array(
            'status' => 'err',
            'error' => "$errstr ($errno)"
        );
    }

    // close the socket connection:
    fclose($fp);

    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);

    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';

    // return as structured array:
    return array(
        'status' => 'ok',
        'header' => $header,
        'content' => $content
    );
}