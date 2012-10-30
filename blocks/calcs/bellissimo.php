<?php
//print_r($_REQUEST);
global $defaultValues;
if (isset($_REQUEST['step']))
    $step = $_REQUEST['step'];
else
    $step = 1;




switch ($step)
{
    case 1:
        if (isset($_SESSION['calc']['bellissimo']))
            $formData = $_SESSION['calc']['bellissimo'];
        else
            $formData = $defaultValues['calc']['bellissimo'];

        $bellissimoForm = new form('bellissimoPrimary');
        $bellissimoForm->setAction("index.php?action=calc&type=3&step=2");
        $bellissimoForm->setMethod("POST");

        //block insured
        $bellissimoForm->putNewBlock('Страхование КАСКО', 'grid');
        $bellissimoForm->addInput(new input('bellissimo[typeOfCar]', 'select', 'Марка ТС:', array('select' => $defaultValues['select']['cars'], 'chose' => $formData['typeOfCar']), 'select'));
        $bellissimoForm->addInput(new input('bellissimo[modelOfCar]', 'select', 'Модель ТС:', array('select' => dbGetCarsModelsByType(array('idType' => $formData['typeOfCar'])), 'chose' => $formData['modelOfCar']), 'select'));
        $bellissimoForm->addInput(new input('bellissimo[yearOfCar]', 'select', 'Год начала эксплуатации:', array('select' => $defaultValues['select']['yearsOfCar'], 'chose' => $formData['yearOfCar']), 'select'));
        $bellissimoForm->addInput(new input('bellissimo[carAmount]', 'slider', 'Стоимость ТС:', $formData['carAmount'],''));
        $bellissimoForm->addInput(new input('bellissimo[isUnderWarranty]', 'select', 'ТС находится на гарантии:', array('select' => $defaultValues['select']['isUnderWarranty'], 'chose' => $formData['isUnderWarranty']), 'select', 3));


        if (isset($_SESSION['calc']['bellissimoDrivers']))
            $formData = $_SESSION['calc']['bellissimoDrivers'];
        else
        {
            global $defaultValues;
            $formData = $defaultValues['calc']['bellissimoDrivers'];
        }
        $bellissimoForm->putNewBlock('Допущенные к управлению','grid', 'drivers');

        if (count($formData['driver'] > 0))
        {
            foreach ($formData['driver'] as $idDriver => $driverInfo)
            {
                $bellissimoForm->addInput(new input('bellissimoDrivers[driver]['.$idDriver.'][birthDay]', 'dataPicker', 'Дата рождения:', $driverInfo['birthDay'], 'text_input', 1));
                $bellissimoForm->addInput(new input('bellissimoDrivers[driver]['.$idDriver.'][experience]', 'text', 'Стаж вождения (полных лет):', $driverInfo['experience'], 'text_input short', 1));
            }
        }
        else
        {
            $bellissimoForm->addInput(new input('bellissimoDrivers[driver][0][birthDay]', 'dataPicker', 'Дата рождения:', "", 'text_input', 1));
            $bellissimoForm->addInput(new input('bellissimoDrivers[driver][0][experience]', 'text', 'Стаж вождения (полных лет):', "", 'text_input short', 1));
        }
		$bellissimoForm->addInput(new input('', 'custom', null, '<a class="small_link italic" onclick="addDriver();">Добавить водителя (не более пяти)</a> <a class="small_link italic" onclick="removeDriver();">Убрать водителя</a>', '', 4));



        if (isset($_SESSION['calc']['bellissimoOthers']))
            $formData = $_SESSION['calc']['bellissimoOthers'];
        else
        {
            global $defaultValues;
            $formData = $defaultValues['calc']['bellissimoOthers'];
        }

        $bellissimoForm->putNewBlock('Дополнительная информация','grid');
        $bellissimoForm->addInput(new input('bellissimoOthers[formOfCompensation]', 'select', 'Форма возмещения:', array('select' => $defaultValues['select']['formOfCompensation'], 'chose' => $formData['formOfCompensation']), 'select', 3 ));

		$bellissimoForm->addInput(new input('bellissimoOthers[antiStealing][0]', 'isCheckbox', 'Установленные ПУС:', $defaultValues['calc']['bellissimoOthers']['antiStealingName'][0], 'boxCheckbox', 3));
        $bellissimoForm->addInput(new input('bellissimoOthers[antiStealing][1]', 'isCheckbox', '', $defaultValues['calc']['bellissimoOthers']['antiStealingName'][1], 'boxCheckbox'));
        $bellissimoForm->addInput(new input('bellissimoOthers[antiStealing][2]', 'isCheckbox', '', $defaultValues['calc']['bellissimoOthers']['antiStealingName'][2], 'boxCheckbox'));
        $bellissimoForm->addInput(new input('bellissimoOthers[antiStealing][3]', 'isCheckbox', '', $defaultValues['calc']['bellissimoOthers']['antiStealingName'][3], 'boxCheckbox'));
        $bellissimoForm->addInput(new input('bellissimoOthers[antiStealing][4]', 'isCheckbox', '', $defaultValues['calc']['bellissimoOthers']['antiStealingName'][4], 'boxCheckbox'));
        $bellissimoForm->addInput(new input('bellissimoOthers[antiStealing][5]', 'isCheckbox', '', $defaultValues['calc']['bellissimoOthers']['antiStealingName'][5], 'boxCheckbox'));

        $bellissimoForm->addInput(new input('sendBellissimo', 'submit', null, 'Далее', 'btn next', 4));
        $bellissimoForm->printForm();
        echo '<script type="text/javascript">
            $("#bellissimoPrimary").click(function(){bellissimoUpdateFirstPage();}).change(function (){bellissimoUpdateFirstPage();});
            bellissimoUpdateFirstPage();
        </script>';
        break;

    case 2:

        $results = calcFinalAward();
	
        $bellissimoForm = new form('bellissimoSecond');
        $bellissimoForm->setAction("index.php?action=calc&type=3&step=3");
        $bellissimoForm->setMethod("POST");


        if (isset($_SESSION['calc']['bellissimoAdditional']))
            $formData = $_SESSION['calc']['bellissimoAdditional'];
        else
            $formData = $defaultValues['calc']['bellissimoAdditional'];
		
		$bellissimoForm->putNewBlock('Cтрахование КАСКО','grid');
		$bellissimoForm->addInput(new input('bellissimo[kasko]', 'text', 'Итоговая премия:', $results, 'text_input short', 3));

        $bellissimoForm->putNewBlock('Дополнительное страхование','grid');

        $bellissimoForm->addInput(new input('bellissimoAdditional[liability]', 'slider', 'Гражданская ответственность', $formData['liability'], 'text_input short', 3));
        $bellissimoForm->addInput(new input('bellissimoAdditional[accident]', 'slider', 'Несчастный случай', $formData['accident'], 'text_input short', 3));
		
		$custom_table = '
		<div class="r2">
		<table class="info_table" border="0" cellspacing="2" cellpadding="2" width="400" id="additionalEquipment">
		  <tr>
			<th scope="col">Наименование оборудования</th>
			<th scope="col">Стоимость</th>
			<th scope="col">Действие</th>
		  </tr>';
        $isLastElement = 0;

        if (count($formData['equipment']) == 0)
            $custom_table .= "<tr id='bellissimoAdditional[equipment][{$id}]'>
                            <td><input class='text_input short' type='text' id='bellissimoAdditional[equipment][0][name]' name='bellissimoAdditional[equipment][0][name]' value='' placeholder='Наименование'></td>
                            <td><input class='text_input short' type='text' id='bellissimoAdditional[equipment][0][cost]' name='bellissimoAdditional[equipment][0][cost]' value='' placeholder='Стоимость'></td>
                            <td><a href='#' name='addEquipment'><img src='/images/faticons/16x16/cog_add.png' onclick='addEquipment(this, {$id})'></a></td></tr>";
        foreach ($formData['equipment'] as $id=>$equipment)
        {
            $isLastElement++;
            $custom_table .= "<tr id='bellissimoAdditional[equipment][{$id}]'>
                <td><input class='text_input short' type='text' id='bellissimoAdditional[equipment][{$id}][name]' name='bellissimoAdditional[equipment][{$id}][name]' value='{$equipment['name']}' placeholder='Наименование'></td>
                <td><input class='text_input short' type='text' id='bellissimoAdditional[equipment][{$id}][cost]' name='bellissimoAdditional[equipment][{$id}][cost]' value='{$equipment['cost']}' placeholder='Стоимость'></td>";
            if (count($formData['equipment']) == $isLastElement)
                $custom_table .= "<td><a href='#' name='addEquipment'><img src='/images/faticons/16x16/cog_add.png' onclick='addEquipment(this, {$id})'></a></td>";
            else
                $custom_table .= "<td><a href='#' name='addEquipment'><img src='/images/faticons/16x16/cog_delete.png' onclick='removeEquipment({$id})'></a></td>";
            $custom_table .= "</tr>";
        }
        $custom_table .= "</table>
        </div>";

		
        $bellissimoForm->addInput(new input('bellissimoAdditional[optionalEquipment]', 'custom', 'Дополнительное оборудование:', $custom_table));
        $bellissimoForm->addInput(new input('bellissimoAdditional[EquipmentkAmount]', 'text', 'Итоговая стоимость дополнительного оборудования:', '', 'text_input short', 3));



        if (isset($_SESSION['calc']['bellissimoMaintenance']))
            $formData = $_SESSION['calc']['bellissimoMaintenance'];
        else
            $formData = $defaultValues['calc']['bellissimoMaintenance'];

        $bellissimoForm->putNewBlock('Программа сопровождения','grid');
		
		$bellissimoForm->addInput(new input('', 'custom', null, '<span class="italic">Территория покрытия: Москва или Москва + МО до 50 км от МКАД</span>', '', 4));
        $bellissimoForm->addInput(new input('bellissimoMaintenance[information][0]', 'checkbox', 'Аварком', $formData['information'][0], 'boxCheckbox',4));
        $bellissimoForm->addInput(new input('bellissimoMaintenance[information][1]', 'checkbox', 'Сбор справок ГИБДД', $formData['information'][1], 'boxCheckbox',4));
        $bellissimoForm->addInput(new input('bellissimoMaintenance[information][2]', 'checkbox', 'Сбор справок ОВД', $formData['information'][2], 'boxCheckbox',4));
        $bellissimoForm->addInput(new input('bellissimoMaintenance[VIPPackAmount]', 'text', 'Итоговая стоимость ВИП пакета:', '', 'text_input short', 3));


        if (isset($_SESSION['calc']['bellissimoDiscount']))
            $formData = $_SESSION['calc']['bellissimoDiscount'];
        else
            $formData = $defaultValues['calc']['bellissimoDiscount'];

        $bellissimoForm->putNewBlock('Снизить стоимость полиса', 'grid');
        $bellissimoForm->addInput(new input('bellissimoDiscount[isTransition]', 'checkbox', 'Безубыточный переход из другой СК:', $formData['isTransition'], 'boxCheckbox', 2));
        $bellissimoForm->addInput(new input('bellissimoDiscount[transition]', 'text', null, $formData['transition'], 'text_input short', 2));
        $bellissimoForm->addInput(new input('', 'newLine', '', '', '', ''));
		$bellissimoForm->addInput(new input('bellissimoDiscount[nomer]', 'text', 'Номер договора:', '', 'text_input short', 3));
		$bellissimoForm->addInput(new input('bellissimoDiscount[polis]', 'text', 'Номер полиса:', '', 'text_input short', 3));
		$bellissimoForm->addInput(new input('bellissimoDiscount[isFranchise]', 'checkbox', 'Вариант франшизы:', $formData['isFranchise'], 'boxCheckbox', '2_5'));
		$bellissimoForm->addInput(new input('bellissimo[Franchise]', 'select', null, array('select' => $defaultValues['select']['franchiseCar'], 'chose' => $formData['franchiseCar']), 'select', 3));
		
        //$bellissimoForm->addInput(new input('bellissimoDiscount[isPromo]', 'checkbox', 'ПромоКод для скидки:', '', 'boxCheckbox','2_5'));
        //$bellissimoForm->addInput(new input('bellissimoDiscount[promo]', 'text', null, '', 'text_input short', 1));
        $bellissimoForm->addInput(new input('bellissimoDiscount[isPolicyNC]', 'checkbox', 'Оформить полис НС за 1000 рублей и получить скидку по КАСКО 10%', $formData['isPolicyNC'], 'boxCheckbox',4));

        $bellissimoForm->addInput(new input('sendBellissimo', 'submit', null, 'Далее', 'btn next', 4));
        $bellissimoForm->printForm();
		
echo '<table class="total_table" border="0" cellspacing="3" cellpadding="3">
<caption>
<span>Итоговая страховая премия</span>
</caption>
<tr>
<td class="t_lable">Страховая премия КАСКО:</td>
<td class="t_input"><input type="text" name="123" class="text_input double" value="123" ></td>
</tr>
<tr>
<td class="t_lable">Стоимость VIP пакета:</td>
<td class="t_input"><input type="text" name="123" class="text_input double" value="123" ></td>
</tr>
<tr>
<td class="t_lable">Страховая премия по гражданской ответственности:</td>
<td class="t_input"><input type="text" name="123" class="text_input double" value="123" ></td>
</tr>
<tr>
<td class="t_lable">Страховая премия от несчастного случая:</td>
<td class="t_input"><input type="text" name="123" class="text_input double" value="123" ></td>
</tr>
<tr>
<td class="t_lable">Страховая премия по дополнительному оборудованию:</td>
<td class="t_input"><input type="text" name="123" class="text_input double" value="123" ></td>
</tr>
<tr>
<td class="t_lable">Итоговая страховая премия:</td>
<td class="t_input"><input type="text" name="123" class="text_input double" value="123" ></td>
</tr>

<tr>
<td class="t_last" colspan="2"></td>
</tr>
</table>
<script type="text/javascript">
    $("#bellissimoSecond").click(function(){bellissimoUpdateSecondPage();}).change(function (){bellissimoUpdateSecondPage();});
    bellissimoUpdateSecondPage();
</script>';
		
        break;

    case 3:
        $bellissimoForm = new form();
        $bellissimoForm->setAction("index.php?action=calc&type=3&step=4");
        $bellissimoForm->setMethod("POST");


        if (isset($_SESSION['calc']['insurant']))
            $formData = $_SESSION['calc']['insurant'];
        else
            $formData = $defaultValues['calc']['insurant'];

        $bellissimoForm->putNewBlock('Основная информация', 'grid');
        $bellissimoForm->addInput(new input('insurant[name]', 'text', 'Страхователь:', $formData['name'], 'text_input long',3));
        $bellissimoForm->addInput(new input('insurant[region]', 'text', 'Адрес регистрации:', $formData['region'], 'text_input long',3));
        $bellissimoForm->addInput(new input('insurant[city]', 'text', ' ', $formData['city'], 'text_input long',3));
        $bellissimoForm->addInput(new input('insurant[street]', 'text', ' ', $formData['street'], 'text_input long',3));
        $bellissimoForm->addInput(new input('insurant[house]', 'text', ' ', $formData['house'], 'text_input short',1));
        $bellissimoForm->addInput(new input('insurant[housing]', 'text', null, $formData['housing'], 'text_input short',1));
        $bellissimoForm->addInput(new input('insurant[apartment]', 'text', null, $formData['apartment'], 'text_input short',1));
        $bellissimoForm->addInput(new input('insurant[passportSeries]', 'text', 'Паспорт:', $formData['passportSeries'], 'text_input short',1));
        $bellissimoForm->addInput(new input('insurant[passportNumber]', 'text', null, $formData['passportNumber'], 'text_input double',2));		
		$bellissimoForm->addInput(new input('insurant[birthday]', 'dataPicker', 'Дата рождения:', $formData['birthday'], 'text_input', 3));
        $bellissimoForm->addInput(new input('insurant[phone]', 'text', 'Телефон:', $formData['phone'], 'text_input short',3));



        if (isset($_SESSION['calc']['bellissimoBeneficiary']))
            $formData = $_SESSION['calc']['bellissimoBeneficiary'];
        else
            $formData = $defaultValues['calc']['bellissimoBeneficiary'];

        $bellissimoForm->putNewBlock('Выгодоприобретатель', 'grid');
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[isInsurant]', 'isCheckbox', ' ' , 'Страхователь является выгодоприобретателем', 'boxCheckbox',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[isAutoInBank]', 'isCheckbox', ' ' , 'Авто находится в залоге банка', 'boxCheckbox',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[bankInfo][name]', 'text', 'Название банка:', $formData['bankInfo']['name'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[bankInfo][region]', 'text', 'Адрес регистрации:', $formData['bankInfo']['region'], 'text_input long'),3);
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[bankInfo][city]', 'text', 'Город:', $formData['bankInfo']['city'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[bankInfo][street]', 'text', 'Улица:', $formData['bankInfo']['street'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[bankInfo][house]', 'text', 'Дом / Корпус:', $formData['bankInfo']['house'], 'text_input short',1));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[bankInfo][housing]', 'text', null, $formData['bankInfo']['housing'], 'text_input short',2));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][name]', 'text', 'ФИО:', $formData['beneficiary']['name'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][region]', 'text', 'Область или край:', $formData['beneficiary']['region'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][city]', 'text', 'Город:', $formData['beneficiary']['city'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][street]', 'text', 'Улица:', $formData['beneficiary']['street'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][house]', 'text', 'Дом / Корпус / Кв.:', $formData['beneficiary']['house'], 'text_input short',1));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][housing]', 'text', null, $formData['beneficiary']['housing'], 'text_input short',1));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][apartment]', 'text', null, $formData['beneficiary']['apartment'], 'text_input short',1));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][passportSeries]', 'text', 'Паспорт:', $formData['beneficiary']['passportSeries'], 'text_input short',1));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][passportNumber]', 'text', null, $formData['beneficiary']['passportNumber'], 'text_input double',2));		
		$bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][birthday]', 'dataPicker', 'Дата рождения:', $formData['beneficiary']['birthday'], 'text_input', 3));
        $bellissimoForm->addInput(new input('bellissimoBeneficiary[beneficiary][phone]', 'text', 'Телефон:', $formData['beneficiary']['phone'], 'text_input short',3));


        if (isset($_SESSION['calc']['bellissimoAutoInfo']))
            $formData = $_SESSION['calc']['bellissimoAutoInfo'];
        else
            $formData = $defaultValues['calc']['bellissimoAutoInfo'];

        $bellissimoForm->putNewBlock('Сведения о страхуемом ТС','grid');
        $bellissimoForm->addInput(new input('bellissimoAutoInfo[typeOfCar]', 'select', 'Марка ТС:', $formData['typeOfCar'], 'select',3));
        $bellissimoForm->addInput(new input('bellissimoAutoInfo[modelOfCar]', 'select', 'Модель ТС:', $formData['modelOfCar'], 'select',3));
        $bellissimoForm->addInput(new input('bellissimoAutoInfo[yearOfCar]', 'select', 'Год выпуска ТС:', $formData['yearOfCar'], 'select',3));
        $bellissimoForm->addInput(new input('bellissimoAutoInfo[VIN]', 'text', 'VIN номер ТС:', $formData['VIN'], 'text_input short'),3);
        $bellissimoForm->addInput(new input('bellissimoAutoInfo[vehicleRegistration]', 'text', 'ПТС:', $formData['vehicleRegistration'], 'text_input double',3));
        $bellissimoForm->addInput(new input('bellissimoAutoInfo[isRegistred]', 'isCheckbox', ' ', 'ТС не зарегистрирован в ГИБДД' ,'boxCheckbox',3));
        $bellissimoForm->addInput(new input('bellissimoAutoInfo[vehicleCertificate]', 'text', 'СТС:', $formData['vehicleCertificate'], 'text_input double',3));
        $bellissimoForm->addInput(new input('bellissimoAutoInfo[stateNumber]', 'text', 'Гос номер:', $formData['stateNumber'], 'text_input double',3));

        if (isset($_SESSION['calc']['bellissimoDrivers']))
            $formData = $_SESSION['calc']['bellissimoDrivers'];
        else
            $formData = $defaultValues['calc']['bellissimoDrivers'];

        $bellissimoForm->putNewBlock('Сведения о допущенных к управлению ТС:','grid');
		$info_table_1 = '
		<table class="info_table" style="width:890px;" border="0" cellspacing="2" cellpadding="2">
		  <tr>
			<th scope="col">ФИО водителя</th>
			<th scope="col">Дата рождения</th>
			<th scope="col">№ в/у</th>
			<th scope="col">Стаж полных лет</th>
		  </tr>';
        foreach ($formData['driver'] as $id => $driver)
        {
            $info_table_1 .= "<tr>
            			<td><input class='text_input short' type='text' id='bellissimoDrivers[driver][{$id}][name]' name='bellissimoDrivers[driver][{$id}][name]' value='{$driver['name']}' placeholder=''></td>
            			<td><input type='hidden' name='bellissimoDrivers[driver][{$id}][birthDay]' value='{$driver['birthDay']}'>{$driver['birthDay']}</td>
            			<td><input class='text_input short' type='text' id='bellissimoDrivers[driver][{$id}][license]' name='bellissimoDrivers[driver][{$id}][license]' value='{$driver['license']}' placeholder=''></td>
            			<td><input type='hidden' name='bellissimoDrivers[driver][{$id}][experience]' value='{$driver['experience']}'>{$driver['experience']}</td>
            		  </tr>";
        }
		$info_table_1 .= '</table>';
		$bellissimoForm->addInput(new input('', 'custom', null, $info_table_1, '', 4));


        if (isset($_SESSION['calc']['bellissimoOthers']))
                    $formData = $_SESSION['calc']['bellissimoOthers'];
                else
                    $formData = $defaultValues['calc']['bellissimoOthers'];

		$bellissimoForm->putNewBlock('Сведения о противоугонных системах:','grid');

        $info_table_2 = '
        		<table class="info_table" style="min-width:445px;" border="0" cellspacing="2" cellpadding="2" id="antiTheftSystem">
        		  <tr>
        			<th scope="col">Пус</th>
        			<th scope="col">Наименование</th>
        		  </tr>';
                foreach ($formData['antiStealing'] as $id=>$equipment)
                {
                    if ($equipment == 0)
                        continue;
                    $info_table_2 .= "<tr>
                        <td>{$defaultValues['calc']['bellissimoOthers']['antiStealingName'][$id]}</td>";
                    if ($id==0)
                        $info_table_2 .= "<td></td>";
                    else
                        $info_table_2 .= "<td><input class='text_input short' type='text' id='bellissimoOthers[antiStealingName][{$id}]' name='bellissimoOthers[antiStealingName][{$id}]' value='' placeholder=''></td>";
                    $info_table_2 .= "</tr>";
                }
        $info_table_2 .= "</table>";

		$bellissimoForm->addInput(new input('', 'custom', null, $info_table_2, '', 4));
		
		
		$bellissimoForm->putNewBlock('Введите адрес места и время осмотра ТС представителем СТРАХОВЩИКА:','grid');
        $bellissimoForm->addInput(new input('bellissimoAddressCheck[region]', 'text', 'Область или край:', $formData['region'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoAddressCheck[city]', 'text', 'Город:', $formData['city'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoAddressCheck[street]', 'text', 'Улица:', $formData['street'], 'text_input long',3));
        $bellissimoForm->addInput(new input('bellissimoAddressCheck[house]', 'text', 'Дом / Корпус:', $formData['house'], 'text_input short',1));
        $bellissimoForm->addInput(new input('bellissimoAddressCheck[housing]', 'text', null, $formData['housing'], 'text_input short',2));		
		$bellissimoForm->addInput(new input('bellissimoAddressCheck[date]', 'dataPicker', 'Дата осмотра ТС (ориентировочно):', $formData['date'], 'text_input', 3));
		$bellissimoForm->addInput(new input('bellissimoRulesCheck', 'isCheckbox', ' ', 'С условиями осмотра и вступления полиса в действие ознакомлен' ,'boxCheckbox',3));
        $bellissimoForm->addInput(new input('sendBellissimo', 'submit', null, 'Далее', 'btn next',4));
        $bellissimoForm->printForm();
        break;

    case 4:
        $bellissimoForm = new form();
        $bellissimoForm->setAction("index.php?action=calc&type=2&step=5");
        $bellissimoForm->setMethod("POST");

        //block insured
        $bellissimoForm->addInput(new input('', 'custom', null, '<b class="warning">ПОЛИС ВСТУПАЕТ В СИЛУ ТОЛЬКО С МОМЕНТА ОПЛАТЫ И ОСМОТРА ТС</b>', '', 4));
        $bellissimoForm->putNewBlock('Выберите вариант рассрочки платежа:', 'grid');
        $bellissimoForm->addInput(new input('payType', 'radio', 'Единовременный платеж', '1', 'boxRadio', 3));
        $bellissimoForm->addInput(new input('payType', 'radio', 'Рассрочка на 2 равных платежа в течение 3-х месяцев', '0', 'boxRadio', 3));
        $bellissimoForm->addInput(new input('payType', 'radio', 'Рассрочка на 2 равных платежа в течение 6-ти месяцев', '0', 'boxRadio', 3));
        $bellissimoForm->addInput(new input('payType', 'radio', 'Рассрочка на 4 равных платежа каждые 3 месяца', '0', 'boxRadio', 3));
        $bellissimoForm->addInput(new input('payType', 'radio', 'Рассрочка на 12 равных платежа каждый месяц', '0', 'boxRadio', 3));
        $bellissimoForm->addInput(new input('payType', 'radio', 'Первый взнос 50%, далее ежедневная оплата', '0', 'boxRadio', 3));
		$bellissimoForm->addInput(new input('', 'custom', null, '<span class="italic"><b class="orange">ОБРАТИТЕ ВНИМАНИЕ!</b><br>Если осмотр и оплата полиса произошли ранее указанного срока, то полис начинает действовать согласно указанному сроку.</span>', '', 4));		
		$bellissimoForm->addInput(new input('payType[0][type]', 'checkbox', 'С <a href="#">Правилами страхования</a> и <a href="#">Полисными условиями</a> ознакомлен', '', 'boxCheckbox', 3));		
        $bellissimoForm->addInput(new input('sendVillaggio', 'submit', '', 'Далее', 'btn next', 4));
        $bellissimoForm->printForm();
		
echo '<table class="total_table" border="0" cellspacing="3" cellpadding="3">
<caption>
<span>Оплатить</span>
</caption>
<tr>
<td class="t_last" style="padding-left:10px;padding-right:10px;padding-top:25px;">
<a href="#" class="p_visa">&nbsp;</a>
<a href="#" class="p_master_card">&nbsp;</a>
<a href="#" class="p_web_money">&nbsp;</a>
<a href="#" class="p_yandex">&nbsp;</a>
<a href="#" class="p_qiwi">&nbsp;</a>
<a href="#" class="p_sms">&nbsp;</a>
</td>
</tr>
</table>';
}
