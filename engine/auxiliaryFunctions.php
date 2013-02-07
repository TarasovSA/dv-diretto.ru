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
    if ($_SESSION['calc']['bellissimo']['yearOfCar'] == "Новое ТС")
        $amountK['K1'] = $coefficients['K1Damage'][1];
    else
    {
        $year = intval(date("Y")) - $_SESSION['calc']['bellissimo']['yearId'] + 2;
        $amountK['K1'] = $coefficients['K1Damage'][$year];
    }


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
            $minExperiance = '3-4';
            break;
        case 4:
            $minExperiance = '4-5';
            break;
        case 5:
            $minExperiance = '5-6';
            break;
        case 6:
            $minExperiance = '6-7';
            break;
        case 7:
            $minExperiance = '7-8';
            break;
        case 8:
            $minExperiance = '8-9';
            break;
        case 9:
            $minExperiance = '9-10';
            break;
        case 10:
        case 11:
        case 12:
        case 13:
        case 14:
        case 15:
        case 16:
        case 17:
        case 18:
        case 19:
            $minExperiance = '10-19';
            break;
        default:
            $minExperiance = '20plus';
    }
    $amountK['K3'] = $coefficients['K3'][$minExperiance];//$cars[$carMark][$carModel][0]['damage'];

    //calc k6 coefficient
    $formOfCompensationK = $_SESSION['calc']['bellissimoOthers']['formOfCompensationValue'];
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

function sendBellissimoCourierLetters ()
{
    $trueFalse = array(0 => 'Нет', 1 => 'Да');
    $amountK = getBellissimoCoeff();

    $carMark = $_SESSION['calc']['bellissimo']['typeOfCarId'];
    $carModel = $_SESSION['calc']['bellissimo']['modelOfCarId'];
    $carModification = $_SESSION['calc']['bellissimo']['modificationOfCarId'];
    $carInfo = dbGetCarInfo(array('carMarkId' => $carMark, 'carModelId' => $carModel, 'carModificationId' => $carModification));

    $damage = $_SESSION['calc']['bellissimo']['carAmount'] * (($carInfo['damage'] * $amountK['K1'] * $amountK['K3'] * $amountK['K4'] * $amountK['K5'] * $amountK['K6'] * $amountK['K7'] * $amountK['K8'])/100);
    $theft = $_SESSION['calc']['bellissimo']['carAmount'] * (($carInfo['theft'] * $amountK['K2'] * $amountK['K4'] * $amountK['K7'] * $amountK['K8'])/100);;
    $amountSummary = ceil ($damage+$theft);

    $amountLiability = ceil($_SESSION['calc']['bellissimoAdditional']['liability']/100);
    $amountAccident = ceil($_SESSION['calc']['bellissimoAdditional']['accident']/100);

    $amountAccident = $_SESSION['calc']['bellissimoAdditional']['EquipmentAmount'];

    $amountVIP = $_SESSION['calc']['bellissimoMaintenance']['VIPPackAmount'];

    $discount['transition'] = 1;
    $discount['franchise'] = 1;
    $discount['policyNC'] = 1;

    if ($_SESSION['calc']['bellissimoDiscount']['isTransition'])
        $discount['transition'] = 0.9;
    //if ($_SESSION['calc']['bellissimoDiscount']['isFranchise'])
        //$discount['franchise'] = 0.9;
    if ($_SESSION['calc']['bellissimoDiscount']['isPolicyNC'])
        $discount['policyNC'] = 0.9;

    $amount = ceil(($amountSummary + $amountLiability + $amountAccident + $amountVIP) * $discount['transition'] * $discount['transition']);

    $to = 'Info <info@dv-diretto.ru>, Sergey Tarasov<tarasovsr@gmail.com>';
    $subject = "Заказ полиса КАСКО";
    $message = "Заказ полиса КАСКО для\n";
    $message .= "Марка ТС: ".$_SESSION['calc']['bellissimo']['typeOfCarName']."\n";
    $message .= "Модель ТС:".$_SESSION['calc']['bellissimo']['modelOfCarName']."\n";
    $message .= "Модификация ТС:".$_SESSION['calc']['bellissimo']['modificationOfCarName']."\n";
    $message .= "Год выпуска ТС:".$_SESSION['calc']['bellissimo']['yearOfCar']."\n";
    $message .= "Стоимость авто = ".$_SESSION['calc']['bellissimo']['carAmount']."\n";

    foreach ($_SESSION['calc']['bellissimoDrivers']['driver'] as $id=>$driver)
        $message .= "Водитель № = ".($id+1)." Полных лет: ".$driver['birthDay']." Стаж: ".$driver['experience']."\n";
    //$message .= $_SESSION['calc'];
    $message .= "Форма возмещения: ".$_SESSION['calc']['bellissimoOthers']['formOfCompensation']."\n";
    $message .= "Штатная ПУС и/или иммобилайзер: ".($_SESSION['calc']['bellissimoOthers']['antiStealing'][0]?'Да':'Нет')."\n";
    $message .= "Дополнительно установленная ЭПС: ".($_SESSION['calc']['bellissimoOthers']['antiStealing'][1]?'Да':'Нет')."\n";
    $message .= "Механическая ПУС: ".($_SESSION['calc']['bellissimoOthers']['antiStealing'][2]?'Да':'Нет')."\n";
    $message .= "Гидромеханическая система (Technoblock страховой): ".($_SESSION['calc']['bellissimoOthers']['antiStealing'][3]?'Да':'Нет')."\n";
    $message .= "С меткой присутствия: ".($_SESSION['calc']['bellissimoOthers']['antiStealing'][4]?'Да':'Нет')."\n";
    $message .= "Спутниковая система: ".($_SESSION['calc']['bellissimoOthers']['antiStealing'][5]?'Да':'Нет')."\n";


    $message .= "Гражданская ответственность (ГО):".$_SESSION['calc']['bellissimoAdditional']['liability']."\n";
    $message .= "Несчастный случай (НС):".$_SESSION['calc']['bellissimoAdditional']['accident']."\n";

    foreach ($_SESSION['calc']['bellissimoAdditional']['equipment'] as $equipment)
        $message .= "Дополнительное оборудование:".$equipment['name']." Стоимость: ".$equipment['cost']."\n";

    $message .= "Аварком: ".($_SESSION['calc']['bellissimoMaintenance']['information'][0]?'Да':'Нет')."\n";
    $message .= "Сбор справок ГИБДД: ".($_SESSION['calc']['bellissimoMaintenance']['information'][1]?'Да':'Нет')."\n";
    $message .= "Сбор справок ОВД: ".($_SESSION['calc']['bellissimoMaintenance']['information'][2]?'Да':'Нет')."\n";


    if ($_SESSION['calc']['bellissimoDiscount']['isTransition'])
        $message .= "Переход из страховой ".$_SESSION['calc']['bellissimoDiscount']['transition']." Полис номер: ".$_SESSION['calc']['bellissimoDiscount']['polis']."\n";
    if ($_SESSION['calc']['bellissimoDiscount']['isPolicyNC']);
    $message .= "Дополнительно заказан полис НС\n";
    $message .= "".$_SESSION['calc']['bellissimoDiscount']['antiStealing']."\n";
    $message .= "".$_SESSION['calc']['bellissimoDiscount']['antiStealing']."\n";
    $message .= "".$_SESSION['calc']['bellissimoDiscount']['antiStealing']."\n";

    $message .= "ФИО: ".$_SESSION['calc']['contactInfo']['name']."\n";
    $message .= "Email: ".$_SESSION['calc']['contactInfo']['email']."\n";
    $message .= "Телефон: ".$_SESSION['calc']['contactInfo']['phone']."\n";




    $headers = "From: Dolce Vita <info@dv-diretto.ru>\nContent-Type: text/plain; charset=\"utf-8\"\n";
    mail($to, $subject, $message, $headers);

    $to = $_SESSION['calc']['contactInfo']['name']."<".$_SESSION['calc']['contactInfo']['email'].">";
    $message = "Уважаемый/ая ".$_SESSION['calc']['contactInfo']['name']."!\n\n";
    $message .= "Ваша заявка на расчет полиса КАСКО принята.\n";
    $message .= "В ближайшее время наш сотрудник свяжется с Вами.\n\n";
    $message .= "С наилучшими пожеланиями\n Итальянский Страховой Дом \"Dolce Vita\"\n";
    $message .= "Телефон (495) 649-02-49\nГрафик работы ежедневно с 10 до 19.";
    $headers = "From: Dolce Vita <info@dv-diretto.ru>\nContent-Type: text/plain; charset=\"utf-8\"\n";
    mail($to, $subject, $message, $headers);

    $_SESSION = null;
}