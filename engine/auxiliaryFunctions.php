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

function calcBellissimoAmount()
{
    $coefficients = getBellissimoCoeff();

    $carMark = $_SESSION['calc']['bellissimo']['typeOfCarId'];
    $carModel = $_SESSION['calc']['bellissimo']['modelOfCarId'];
    $carModification = $_SESSION['calc']['bellissimo']['modificationOfCarId'];
    $carInfo = dbGetCarInfo(array('carMarkId' => $carMark, 'carModelId' => $carModel, 'carModificationId' => $carModification));

    $damage = $_SESSION['calc']['bellissimo']['carAmount'] * (($carInfo['damage'] * $coefficients['K1'] * $coefficients['K3'] * $coefficients['K4'] * $coefficients['K5'] * $coefficients['K6'] * $coefficients['K7'])/100);
    $theft = $_SESSION['calc']['bellissimo']['carAmount'] * (($carInfo['theft'] * $coefficients['K2'] * $coefficients['K4'] * $coefficients['K7'] * $coefficients['K8'])/100);

    $amountSummary = ceil ($damage+$theft);

    $Tdo = (7.9 * $coefficients['K1'] * $coefficients['K7'] * 0.95)/100;
    $Tgo = (0.099 * $coefficients['K7'] * 0.95)/100; //0.95 - payment coefficient
    $Tns = (0.24 * $coefficients['K7'] * 0.95)/100; //0.95 - payment coefficient
    $amount['EquipmentAmount'] = 0;

    foreach ($_SESSION['calc']['bellissimoAdditional']['equipment'] as $equipment)
        $amount['EquipmentAmount'] += $equipment['cost'] * $Tdo;

    $amount['vipSumm'] = 0;
    if ($_SESSION['calc']['bellissimoMaintenance']['information'][0])
        $amount['vipSumm'] += 1500;
    if ($_SESSION['calc']['bellissimoMaintenance']['information'][1])
        $amount['vipSumm'] += 1000;
    if ($_SESSION['calc']['bellissimoMaintenance']['information'][2])
        $amount['vipSumm'] += 2000;

    if ($_SESSION['calc']['bellissimo']['carAmount']>750000)
        $amount['vipSumm'] = 'Бесплатно';

    $amount['liability'] = $_SESSION['calc']['bellissimoAdditional']['liability'] * $Tgo;
    $amount['accident'] = $_SESSION['calc']['bellissimoAdditional']['accident'] * $Tns;

    $discount = array('transition' => 1, 'franchise' => 1, 'polisNC' => 1.0);
    $amount['polisNCAmount'] = 0;

    if ($_SESSION['calc']['bellissimoDiscount']['isTransition'])
        $discount['transition'] = 0.9;

    if ($_SESSION['calc']['bellissimoDiscount']['isFranchise'])
    {
        $c = ($_SESSION['calc']['bellissimoDiscount']['FranchiseId']/$_SESSION['calc']['bellissimo']['carAmount'])*100;
        if ($c == 0){
            $discount['franchise'] = 1;
        }
        else{
            $discount['franchise'] = (90*pow(2.71, (-0.0953*$c))/100);
        }
    }
    if ($_SESSION['calc']['bellissimoDiscount']['isPolicyNC']){
        $discount['polisNC'] = 0.9;
        $amount['polisNCAmount'] = 1000;
    }

    $amount['kasko'] = ceil($amountSummary * $discount['transition'] * $discount['franchise'] * $discount['polisNC'] * 0.95) + $amount['polisNCAmount']; //0.95 - payment coefficient


    if ($amount['vipSumm'] == 'Бесплатно'){
        $amount['VIPPackAmount'] = $amount['vipSumm'];
        $amount['vipSumm'] = 0;
    }
    else{
        $amount['VIPPackAmount'] = ceil($amount['vipSumm']);
    }

    $amount['amountSummary'] = ceil($amountSummary * $discount['transition'] * $discount['polisNC'] * $discount['franchise'] * 0.95) + $amount['EquipmentAmount'] + $amount['liability'] + $amount['accident'] + $amount['vipSumm'] + $amount['polisNCAmount'];

    return $amount;
}

function sendBellissimoCourierLetters ()
{
    $amount = calcBellissimoAmount();


    $to = 'Info <info@dv-diretto.ru>, Sergey Tarasov<tarasovsr@gmail.com>, <ermaxx@mail.ru>, <hermes-67@mail.ru>, <garikpv@mail.ru>, Кочешков Герман <KocheshkovG@dv-diretto.ru >, selesta20@list.ru';
    //$to = 'Sergey Tarasov<tarasovsr@gmail.com>';
    $subject = "Заказ полиса КАСКО от ".$_SESSION['calc']['contactInfo']['name'];

    $message = file_get_contents ('engine/mailHeader.html', 'r');
    $message .= '<tr><td colspan="2"><div style="width: 885px; font-weight: bold; font-size: 11pt; text-align: left; padding: 5px; margin: 2px; min-height: 24px; float: left;">Основная информация:</div></td></tr>';
    $message .= "<tr><td style=\"width: 400px\">Марка ТС</td><td>".$_SESSION['calc']['bellissimo']['typeOfCarName']."</td></tr>";
    $message .= "<tr><td>Модель ТС</td><td>".$_SESSION['calc']['bellissimo']['modelOfCarName']."</td></tr>";
    $message .= "<tr><td>Модификация ТС</td><td>".$_SESSION['calc']['bellissimo']['modificationOfCarName']."</td></tr>";
    $message .= "<tr><td>Год выпуска ТС</td><td>".$_SESSION['calc']['bellissimo']['yearOfCar']."</td></tr>";
    $message .= "<tr><td>Стоимость авто</td><td>".$_SESSION['calc']['bellissimo']['carAmount']."</td></tr>";
    $message .= '<tr><td colspan="2"><div style="width: 885px; font-weight: bold; font-size: 11pt; text-align: left; padding: 5px; margin: 2px; min-height: 24px; float: left;">Водители:</div></td></tr>';
    foreach ($_SESSION['calc']['bellissimoDrivers']['driver'] as $id=>$driver)
        $message .= "<tr><td>Водитель № = ".($id+1)." Полных лет: ".$driver['birthDay']." Стаж: ".$driver['experience']."</td></tr>";
    //$message .= $_SESSION['calc'];
    $message .= '<tr><td colspan="2"><div style="width: 885px; font-weight: bold; font-size: 11pt; text-align: left; padding: 5px; margin: 2px; min-height: 24px; float: left;">Форма возмещения:</div></td></tr>';
    $message .= "<tr><td>Форма возмещения: </td><td>".$_SESSION['calc']['bellissimoOthers']['formOfCompensation']."</td></tr>";
    $message .= '<tr><td colspan="2"><div style="width: 885px; font-weight: bold; font-size: 11pt; text-align: left; padding: 5px; margin: 2px; min-height: 24px; float: left;">ПУС:</div></td></tr>';
    $message .= "<tr><td>Штатная ПУС и/или иммобилайзер</td><td>".($_SESSION['calc']['bellissimoOthers']['antiStealing'][0]?'Да':'Нет')."</td></tr>";
    $message .= "<tr><td>Дополнительно установленная ЭПС</td><td>".($_SESSION['calc']['bellissimoOthers']['antiStealing'][1]?'Да':'Нет')."</td></tr>";
    $message .= "<tr><td>Механическая ПУС</td><td>".($_SESSION['calc']['bellissimoOthers']['antiStealing'][2]?'Да':'Нет')."</td></tr>";
    $message .= "<tr><td>Гидромеханическая система (Technoblock страховой)</td><td>".($_SESSION['calc']['bellissimoOthers']['antiStealing'][3]?'Да':'Нет')."</td></tr>";
    $message .= "<tr><td>С меткой присутствия</td><td>".($_SESSION['calc']['bellissimoOthers']['antiStealing'][4]?'Да':'Нет')."</td></tr>";
    $message .= "<tr><td>Спутниковая система</td><td>".($_SESSION['calc']['bellissimoOthers']['antiStealing'][5]?'Да':'Нет')."</td></tr>";

    $message .= '<tr></tr><td colspan="2"><div style="width: 885px; font-weight: bold; font-size: 11pt; text-align: left; padding: 5px; margin: 2px; min-height: 24px; float: left;">Дополнительное страхование:</div></td></tr>';
    $message .= "<tr><td>Гражданская ответственность (ГО)</td><td>".$_SESSION['calc']['bellissimoAdditional']['liability']."</td></tr>";
    $message .= "<tr><td>Стоимость страхования ГО</td><td>".$amount['liability']."</td></tr>";
    $message .= "<tr><td>Несчастный случай (НС)</td><td>".$_SESSION['calc']['bellissimoAdditional']['accident']."</td></tr>";
    $message .= "<tr><td>Стоимость страхования НС</td><td>".$amount['accident']."</td></tr>";

    foreach ($_SESSION['calc']['bellissimoAdditional']['equipment'] as $equipment)
        $message .= "<tr><td>Дополнительное оборудование:".$equipment['name']."</td><td> Стоимость: ".$equipment['cost']."</td></tr>";

    $message .= "<tr><td>Стоимость страхования доп. оборудования</td><td>".$amount['EquipmentAmount']."</td></tr>";

    $message .= '<tr><td colspan="2"><div style="width: 885px; font-weight: bold; font-size: 11pt; text-align: left; padding: 5px; margin: 2px; min-height: 24px; float: left;">VIP пакет (территория покрытия Москва+МО до 50 км от МКАД):</div></td></tr>';
    $message .= "<tr><td>Аварком</td><td>".($_SESSION['calc']['bellissimoMaintenance']['information'][0]?'Да':'Нет')."</td></tr>";
    $message .= "<tr><td>Сбор справок ГИБДД</td><td>".($_SESSION['calc']['bellissimoMaintenance']['information'][1]?'Да':'Нет')."</td></tr>";
    $message .= "<tr><td>Сбор справок ОВД</td><td>".($_SESSION['calc']['bellissimoMaintenance']['information'][2]?'Да':'Нет')."</td></tr>";

    $message .= "<tr><td>VIP пакет</td><td>".$amount['VIPPackAmount']."</td></tr>";



    if ($_SESSION['calc']['bellissimoDiscount']['isTransition'])
        $message .= "<tr><td>Переход из страховой ".$_SESSION['calc']['bellissimoDiscount']['transition']." Полис номер</td><td>".$_SESSION['calc']['bellissimoDiscount']['polis']."</td></tr>";
    if ($_SESSION['calc']['bellissimoDiscount']['isPolicyNC']);
    $message .= "<tr><td>Дополнительно заказан полис НС\n"."</td></tr>";
    $message .= "<tr><td>".$_SESSION['calc']['bellissimoDiscount']['antiStealing'][0]."</td></tr>";
    $message .= "<tr><td>".$_SESSION['calc']['bellissimoDiscount']['antiStealing'][1]."</td></tr>";
    $message .= "<tr><td>".$_SESSION['calc']['bellissimoDiscount']['antiStealing'][2]."</td></tr>";

    $message .= "<tr><td>Стоимость VIP пакет</td><td>".$amount['vipSumm']."</td></tr>";
    $message .= "<tr><td>Стоимость КАСКО</td><td>".$amount['kasko']." (Без учета стоимости полиса НС)</td></tr>";
    $message .= "<tr><td>Общая стоимость страхования</td><td>".$amount['amountSummary']."</td></tr>";

    $message .= "<tr><td>ФИО</td><td>".$_SESSION['calc']['contactInfo']['name']."</td></tr>";
    $message .= "<tr><td>Email</td><td>".$_SESSION['calc']['contactInfo']['email']."</td></tr>";
    $message .= "<tr><td>Телефон</td><td>".$_SESSION['calc']['contactInfo']['phone']."</td></tr>";
    $message .= file_get_contents ('engine/mailFooter.html', 'r');




    $headers = "From: Dolce Vita <info@dv-diretto.ru>\nContent-Type: text/html; charset=\"utf-8\"\n";
    mail($to, $subject, $message, $headers);

    $to = $_SESSION['calc']['contactInfo']['name']."<".$_SESSION['calc']['contactInfo']['email'].">";
    $message = "Уважаемый/ая ".$_SESSION['calc']['contactInfo']['name']."!\n\n";
    $message .= "Ваша заявка на расчет полиса КАСКО принята.\n";
    $message .= "В ближайшее время наш сотрудник свяжется с Вами.\n\n";
    $message .= "С наилучшими пожеланиями\nИтальянский Страховой Дом \"Dolce Vita\"\n";
    $message .= "Телефон (495) 649-02-49\nГрафик работы ежедневно с 10 до 19.";
    $headers = "From: Dolce Vita <info@dv-diretto.ru>\nContent-Type: text/html; charset=\"utf-8\"\n";
    mail($to, $subject, $message, $headers);

    $_SESSION = array();
}

