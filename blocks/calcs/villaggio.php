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
        if (isset($_SESSION['calc']['villaggio']))
            $formData = $_SESSION['calc']['villaggio'];
        else
            $formData = $defaultValues['calc']['villaggio'];

        $villaggioForm = new form();
        $villaggioForm->setAction("index.php?action=calc&type=0&step=2");
        $villaggioForm->setMethod("POST");

        //block insurant
        $villaggioForm->putNewBlock('Основная информация', 'grid g_left g_none');

        $villaggioForm->addInput(new input('villaggio[constructionEl]', 'slider', 'Конструктивные элементы', $formData['constructionEl'], '', 1));
        $villaggioForm->addInput(new input('', 'newLine', '', '', '', ''));
        $villaggioForm->addInput(new input(array ('checkbox' => 'villaggio[isExteriorTrim]', 'slider' => 'villaggio[exteriorTrim]'), 'isSlider', 'Внешняя отделка', array('checkbox' => $formData['isExteriorTrim'], 'slider' => $formData['exteriorTrim']), '', 1));
        $villaggioForm->addInput(new input(array ('checkbox' => 'villaggio[isInteriorTrim]', 'slider' => 'villaggio[interiorTrim]'), 'isSlider', 'Внутренняя отделка', array('checkbox' => $formData['isInteriorTrim'], 'slider' => $formData['interiorTrim']), '', 1));

        $villaggioForm->addInput(new input(array ('checkbox' => 'villaggio[isEngineeringSystems]', 'slider' => 'villaggio[engineeringSystems]'), 'isSlider', 'Инженерные системы', array('checkbox' => $formData['isEngineeringSystems'], 'slider' => $formData['engineeringSystems']), '', 1));
        $villaggioForm->addInput(new input(array ('checkbox' => 'villaggio[isProperty]', 'slider' => 'villaggio[property]'), 'isSlider', 'Имущество', array('checkbox' => $formData['isProperty'], 'slider' => $formData['property']), '', 1));
        $villaggioForm->addInput(new input('', 'newLine', '', '', '', ''));
        $villaggioForm->addInput(new input(array ('checkbox' => 'villaggio[isLiability]', 'slider' => 'villaggio[liability]'), 'isSlider', 'Гражданская ответственность', array('checkbox' => $formData['isLiability'], 'slider' => $formData['liability']), '', 1));

        //block territory of insure
        $villaggioForm->putNewBlock('Дополнительные строения', 'grid g_right g_none', 'additionalStructures');

        $formData = NULL;
        if (isset($_SESSION['calc']['villaggioAdditionalStruct']))
            $formData = $_SESSION['calc']['villaggioAdditionalStruct'];
        $villaggioForm->addInput(new input(array ('checkbox' => 'villaggioAdditionalStruct[0][name]', 'slider' => 'villaggioAdditionalStruct[0][value]'), 'isSlider', 'Баня', array('checkbox' => $formData[0]['name'], 'slider' => $formData[0]['value']), 'text_input short', 1));
		$villaggioForm->addInput(new input(array ('checkbox' => 'villaggioAdditionalStruct[1][name]', 'slider' => 'villaggioAdditionalStruct[1][value]'), 'isSlider', 'Хозблок', array('checkbox' => $formData[1]['name'], 'slider' => $formData[1]['value']), 'text_input short', 1));
		$villaggioForm->addInput(new input(array ('checkbox' => 'villaggioAdditionalStruct[2][name]', 'slider' => 'villaggioAdditionalStruct[2][value]'), 'isSlider', 'Гараж', array('checkbox' => $formData[2]['name'], 'slider' => $formData[2]['value']), 'text_input short', 1));
		$villaggioForm->addInput(new input(array ('checkbox' => 'villaggioAdditionalStruct[3][name]', 'slider' => 'villaggioAdditionalStruct[3][value]'), 'isSlider', 'Забор', array('checkbox' => $formData[3]['name'], 'slider' => $formData[3]['value']), 'text_input short', 1));

        $villaggioForm->addInput(new input('', 'custom', '', '<a href="#" onclick="addNewAdditionalStructure();">Добавить строение</a>', '', 1));
        $villaggioForm->addInput(new input('', 'newLine', '', '', '', ''));
        foreach ($formData as $number => $additionalStructures)
        {
            if ($number > 3)
                $villaggioForm->addInput(new input(array ('checkbox' => 'villaggioAdditionalStruct['.$number.'][name]', 'slider' => 'villaggioAdditionalStruct['.$number.'][value]', 'hidden' => 'villaggioAdditionalStruct['.$number.'][fieldName]'), 'isSlider', $additionalStructures['fieldName'], array('checkbox' => $additionalStructures['name'], 'slider' => $additionalStructures['value'], 'hidden' => $additionalStructures['fieldName']), 'text_input short', 1));
        }
		//$villaggioForm->addInput(new input('villaggioAdditionalStruct[0][type]', 'isSlider', 'Прочие строения', '20000', 'text_input short', 1));*/
        //$villaggioForm->addInput(new input('villaggioAdditionalStruct[0][value]', 'slider', 'Стоимость', '12312', '', 1));
		
		$villaggioForm->putNewBlock('Предметы ландшафтного дизайна', 'grid g_none');
		$villaggioForm->addInput(new input('villaggioAdditionalStruct[0][type]', 'isSlider', 'Ландшафтный дизайн', '30000', 'text_input short', 1));

		
        $villaggioForm->addInput(new input('sendVillaggio', 'submit', '', 'Далее', 'btn next', 4));

		$villaggioForm->printForm();
		
echo '<table class="total_table" border="0" cellspacing="3" cellpadding="3">
<caption>
<span>Итого</span>
</caption>
<tr>
<td class="t_lable">Итого стоимость полиса в год:</td>
<td class="t_input"><input type="text" name="123" class="text_input double" value="123" ></td>
</tr>
<tr>
<td colspan="2" class="t_last"><p>
<b>По данному полису включены следующие риски:</b>
<ul>
<li>Пожар</li>
<li>Залив</li>
<li>Стихийные бедствия</li>
<li>Механическое повреждение</li>
</ul>
<i>*окончательная стоимость будет определена от формы рассрочки платежей</i>
</p>
</td>
</tr>
</table>';
        break;

    case 2:
        if (isset($_SESSION['calc']['insurant']))
            $formData = $_SESSION['calc']['insurant'];
        else
            $formData = $defaultValues['calc']['insurant'];

        $villaggioForm = new form();
        $villaggioForm->setAction("index.php?action=calc&type=0&step=3");
        $villaggioForm->setMethod("POST");

        //block insurant
        $villaggioForm->putNewBlock('Информация о страхователе', 'grid');
        $villaggioForm->addInput(new input('insurant[name]', 'text', 'Страхователь:', $formData['name'], 'text_input long', 3));
        $villaggioForm->addInput(new input('insurant[region]', 'text', 'Адрес регистрации:', $formData['region'], 'text_input long', 3));
        $villaggioForm->addInput(new input('insurant[city]', 'text', ' ', $formData['city'], 'text_input long', 3));
        $villaggioForm->addInput(new input('insurant[street]', 'text', ' ', $formData['street'], 'text_input long', 3));
        $villaggioForm->addInput(new input('insurant[house]', 'text', ' ', $formData['house'], 'text_input', 1));
        $villaggioForm->addInput(new input('insurant[housing]', 'text', null, $formData['housing'], 'text_input', 1));
        $villaggioForm->addInput(new input('insurant[apartment]', 'text', null, $formData['apartment'], 'text_input', 1));
        $villaggioForm->addInput(new input('insurant[passportSeries]', 'text', 'Паспорт:', $formData['passportSeries'], 'text_input', 1));
        $villaggioForm->addInput(new input('insurant[passportNumber]', 'text', null, $formData['passportNumber'], 'text_input double', 2));
        $villaggioForm->addInput(new input('insurant[birthday]', 'dataPicker', 'Дата рождения:', $formData['birthday'], 'text_input', 1));
        $villaggioForm->addInput(new input('', 'newLine', '', '', '', ''));
        $villaggioForm->addInput(new input('insurant[phone]', 'text', 'Контактный телефон:', $formData['phone'], 'text_input short', 1));
		$villaggioForm->addInput(new input('', 'custom', null, '<a href="#" class="small_link italic">подтвердить по sms код авторизации</a>', '', 2));

        //block territory of insure
        if (isset($_SESSION['calc']['villaggioTerritory']))
            $formData = $_SESSION['calc']['villaggioTerritory'];
        else
        {
            global $defaultValues;
            $formData = $defaultValues['calc']['villaggioTerritory'];
        }
        $villaggioForm->putNewBlock('Территория страхования', 'grid');
        $villaggioForm->addInput(new input('villaggioTerritory[region]', 'text', 'Область или край', $formData['region'], 'text_input long', 3));
        $villaggioForm->addInput(new input('villaggioTerritory[city]', 'text', 'Город', $formData['city'], 'text_input long', 3));
        $villaggioForm->addInput(new input('villaggioTerritory[street]', 'text', ' ', $formData['street'], 'text_input long', 3));
        $villaggioForm->addInput(new input('villaggioTerritory[house]', 'text', ' ', $formData['house'], 'text_input', 1));
        $villaggioForm->addInput(new input('villaggioTerritory[housing]', 'text', null, $formData['housing'], 'text_input', 1));

        //beneficiary block
        if (isset($_SESSION['calc']['beneficiary']))
            $formData = $_SESSION['calc']['beneficiary'];
        else
        {
            global $defaultValues;
            $formData = $defaultValues['calc']['beneficiary'];
        }
        $villaggioForm->putNewBlock('Выгодоприобретатель', 'grid');
		$villaggioForm->addInput(new input('insurant[beneficiary]', 'isCheckbox', ' ', 'Страхователь является выгодоприобретателем страхуемого имущества', 'boxCheckbox', 3));
        $villaggioForm->addInput(new input('beneficiary[name]', 'text', 'ФИО', $formData['name'], 'text_input long', 3));
        $villaggioForm->addInput(new input('beneficiary[birthday]', 'dataPicker', 'Дата рождения:', $formData['birthday'], 'text_input', 1));
        $villaggioForm->addInput(new input('', 'newLine', '', '', '', ''));
        $villaggioForm->addInput(new input('sendVillaggio', 'submit', '', 'Далее', 'btn next', 4));
        $villaggioForm->printForm();
        break;
    case 3:
        $villaggioForm = new form();
        $villaggioForm->setAction("index.php?action=calc&type=0&step=4");
        $villaggioForm->setMethod("POST");

        $villaggioForm->addInput(new input('', 'custom', null, '<b class="warning">ОБРАТИТЕ ВНИМАНИЕ, ЧТО ПОЛИС ВСТУПАЕТ В СИЛУ ТОЛЬКО НА 5-е СУТКИ ПОСЛЕ ОПЛАТЫ</b>', '', 4));
        $villaggioForm->putNewBlock('Выберите вариант рассрочки платежа:', 'grid');
        $villaggioForm->addInput(new input('payType', 'radio', 'Единовременный платеж', '', 'boxRadio', 3));
        $villaggioForm->addInput(new input('payType', 'radio', 'Рассрочка на 2 равных платежа в течение 3-х месяцев', '', 'boxRadio', 3));
        $villaggioForm->addInput(new input('payType', 'radio', 'Рассрочка на 2 равных платежа в течение 6-ти месяцев', '', 'boxRadio', 3));
        $villaggioForm->addInput(new input('payType', 'radio', 'Рассрочка на 4 равных платежа каждые 3 месяца', '', 'boxRadio', 3));
        $villaggioForm->addInput(new input('payType', 'radio', 'Рассрочка на 12 равных платежа каждый месяц', '', 'boxRadio', 3));
        $villaggioForm->addInput(new input('payType', 'radio', 'Ежедневная рассрочка платежей', '', 'boxRadio', 3));
		$villaggioForm->addInput(new input('', 'custom', null, '<span style="margin-left:25px;">Введите ПРОМОКОД для получения скидки:</span>', '', 2));
		$villaggioForm->addInput(new input('payType[promo]', 'text', null, $formData['name'], 'text_input short', 1));
		$villaggioForm->addInput(new input('payType[0][type]', 'checkbox', 'С <a href="#">Правилами страхования</a> и <a href="#">Полисными условиями</a> ознакомлен', '', 'boxCheckbox', 3));
		
        $villaggioForm->addInput(new input('sendVillaggio', 'submit', '', 'Далее', 'btn next', 4));
        $villaggioForm->printForm();
		
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
		
		break;
}
