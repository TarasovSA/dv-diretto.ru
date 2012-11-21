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

function calcFinalAward()
{
    $carMark = $_SESSION['calc']['bellissimo']['typeOfCarId'];
    $carModel = $_SESSION['calc']['bellissimo']['modelOfCarId'];
    $year = $_SESSION['calc']['bellissimo']['yearOfCar'];
    $cars = dbGetCar(array('carMarkId' => $carMark, 'carModelId' => $carModel));
    $damage = 0;
    $damageK = 0;//$cars[$carMark][$carModel][0]['damage'];
    //echo $damageK;
    $theftK = 0;//$cars[$carMark][$carModel][0]['theft'];
    $yearK = $year;
    //echo $yearK;
    $isUnderWarrantyK = $_SESSION['calc']['bellissimo']['isUnderWarranty'];
    //echo $isUnderWarrantyK;
    $formOfCompensationK = $_SESSION['calc']['bellissimoOthers']['formOfCompensation'];
    //echo $formOfCompensationK;

    $inexperienced = 10;
    foreach ($_SESSION['calc']['bellissimoDrivers']['driver'] as $driver)
    {
        if ($inexperienced > $driver['experience'])
            $inexperienced = $driver['experience'];
    }
    $inexperiencedK = $inexperienced;
    //echo $inexperiencedK;
    $damage = $_SESSION['calc']['bellissimo']['carAmount'] * $damageK * $yearK * $isUnderWarrantyK * $formOfCompensationK * $inexperiencedK;
    $theft = $_SESSION['calc']['bellissimo']['carAmount'] * $theftK * $yearK ;

    return $damage + $theft;

}