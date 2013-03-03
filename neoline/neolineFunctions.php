<?php
/**
 * Created by JetBrains PhpStorm.
 * User: starasov
 * Date: 22.02.13
 * Time: 14:49
 * To change this template use File | Settings | File Templates.
 */
$idPartner = addslashes('tarasovsr@gmail.com');

function APIRequest($id, $phone, $amount)
{
    global $idPartner;

    $url = "http://mc.neoline.biz/dolche/api.php?action=ApiRequest&number={$id}&amount={$amount}&phone={$phone}";
    $opts = array(
        'http'=>array(
            'method'=>"GET"
        )
    );
    $context = stream_context_create($opts);

    $result = file_get_contents($url, NULL, $context);
    print_r ($result);

}

APIRequest($idPartner, 9169616509, 10);