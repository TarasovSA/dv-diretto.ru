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



$file = file_get_contents('http://www.sravni.ru/Kasko/Suggest/Cars/');
echo "Got list with cars mark...</br>\n";
preg_match_all('/<a href="javascript:void\(\'0\'\)" data-fullname="[a-z0-9а-яА-Я\(\)\s-]+">([a-z0-9а-яА-Я\(\)\s-]+)<\/a>/i', $file, $matches);

foreach ($matches[1] as $mark)
{
    echo "Add to DB {$mark}...</br>\n";
    try {
        $STH = $DBH->prepare("INSERT INTO `carsMarks` (markName) VALUES (:markName)");
        $STH->execute(array('markName' => $mark));
        $id = $DBH->lastInsertId();
        echo "Added {$mark} with id = {$id} to DB</br>\n";

        $post_data = array(
            'car' => $mark
        );

        $models = post_request('http://www.sravni.ru/Kasko/Suggest/Cars/', $post_data);
        preg_match_all('/<a href="javascript:void\(\'0\'\)" data-fullname="[a-z0-9а-яА-Я\(\)\s-]+">([a-z0-9а-яА-Я\(\)\s-]+)<\/a>/i', $models['content'], $modelMatches);
        foreach ($modelMatches[1] as $model)
        {
            echo "\tAdd to DB {$model}...</br>\n";
            try {
                $STH = $DBH->prepare("INSERT INTO `carsModels` (idMark, modelName) VALUES (:idMark, :modelName)");
                $STH->execute(array('idMark' => $id, 'modelName' => $model));
                $idModel = $DBH->lastInsertId();
                echo "Added {$model} with id = {$idModel} to DB</br>\n";
            }
            catch (PDOException $e)
            {
                errorMessageHandler($e);
            }
        }

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

