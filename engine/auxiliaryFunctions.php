<?php



// set Background Class
function selectContentBg()
{
    $types = array (0, 1, 2, 3);
    $backgroundClass = '';
    if (isset($_REQUEST['type']) AND in_array($_REQUEST['type'], $types))
    {
        switch ($_REQUEST['type'])
        {
            case 0: $backgroundClass = "_villagio"; break;
            case 1: $backgroundClass = "_felicecitta"; break;
            case 2: $backgroundClass = "_bellavita"; break;
            case 3: $backgroundClass = "_bellissimo"; break;
        }
    }
    else
        $backgroundClass = '';
    return "content_bg".$backgroundClass;
}

function getBellissimoCoeff()
{
    $coefficients = dbGetCoefficientsForCalc(array('calc' => 3));


    //calc k1 coefficient
    $year = $_SESSION['calc']['bellissimo']['yearOfCar'];
    $amountK['K1'] = $coefficients['K1Damage'][$year];

    //calc k2 coefficient
    $amountK['K2'] = $coefficients['K1Theft'][$year];

    //calc k3 coefficient
    $drivers = $_SESSION['calc']['bellissimoDrivers']['driver'];
    $minExperiance = null;
    foreach ($drivers as $driver)
    {
        if ($minExperiance == null OR $minExperiance>$driver['experience'])
            $minExperiance = $driver['experience'];
    }

    switch ($minExperiance)
    {
        case 0:
            $minExperiance = '0-1';
            break;
        case 1:
            $minExperiance = '1-2';
            break;
        case 2:
            $minExperiance = '2-3';
            break;
        case 3:
        case 4:
            $minExperiance = '3-5';
            break;
        case 5:
        case 6:
        case 7:
        case 8:
        case 9:
            $minExperiance = '5-10';
            break;
        default:
            $minExperiance = '10plus';
    }
    $amountK['K3'] = $coefficients['K3'][$minExperiance];//$cars[$carMark][$carModel][0]['damage'];

    //calc k6 coefficient
    $formOfCompensationK = $_SESSION['calc']['bellissimoOthers']['formOfCompensation'];
    if ($year < 5)
        $amountK['K6'] = $coefficients['K6NewCars'][$formOfCompensationK];
    else
        $amountK['K6'] = $coefficients['K6OldCars'][$formOfCompensationK];

    //calc k8 coefficient
    $antiStealing = $_SESSION['calc']['bellissimoOthers']['antiStealing'];
    if (isset($antiStealing[5]) AND $antiStealing[5] == 1)
        $amountK['K8'] = $coefficients['K8'][7];
    elseif (isset($antiStealing[4]) AND $antiStealing[4] == 1)
        $amountK['K8'] = $coefficients['K8'][6];
    elseif (isset($antiStealing[4]) AND $antiStealing[3] == 1)
        $amountK['K8'] = $coefficients['K8'][5];
    elseif (isset($antiStealing[0]) AND isset($antiStealing[1]) AND isset($antiStealing[2]) AND $antiStealing[0] == 1 AND $antiStealing[1] == 1 AND $antiStealing[2] == 1)
        $amountK['K8'] = $coefficients['K8'][4];
    elseif (isset($antiStealing[0]) AND isset($antiStealing[2]) AND $antiStealing[0] == 1 AND $antiStealing[2] == 1)
        $amountK['K8'] = $coefficients['K8'][3];
    elseif (isset($antiStealing[0]) AND isset($antiStealing[1]) AND $antiStealing[0] == 1 AND $antiStealing[1] == 1)
        $amountK['K8'] = $coefficients['K8'][2];
    else
        $amountK['K8'] = $coefficients['K8'][1];

    //k4,k5,k7 coefficient
    $amountK['K4'] = 1;
    $amountK['K5'] = 1;
    $amountK['K7'] = 1;

    //$damage = $_SESSION['calc']['bellissimo']['carAmount'] * (($carInfo['damage'] * $amountK['K1'] * $amountK['K3'] * $amountK['K4'] * $amountK['K5'] * $amountK['K6'] * $amountK['K7'] * $amountK['K8'])/100);
    //$theft = $_SESSION['calc']['bellissimo']['carAmount'] * (($carInfo['theft'] * $amountK['K2'] * $amountK['K4'] * $amountK['K7'] * $amountK['K8'])/100);

    //return ceil($damage + $theft);
    return $amountK;

}