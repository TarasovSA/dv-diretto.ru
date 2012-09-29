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
        if (isset($_SESSION['calc']['bellaVita']))
            $formData = $_SESSION['calc']['bellaVita'];
        else
            $formData = $defaultValues['calc']['bellaVita'];


        $bvForm = new form();
        $bvForm->setAction("index.php?action=calc&type=2&step=2");
        $bvForm->setMethod("POST");

        //block insured
        $bvForm->putNewBlock('Страхование от несчастного случая:','grid g_none');
        $bvForm->addInput(new input('bellaVita[insuranceAmount]', 'slider', 'Выберите страховую сумму:', $formData['insuranceAmount'], '', 3));
        $bvForm->addInput(new input('sendbellaVita', 'submit', null, 'Далее', 'btn next', 4));
        $bvForm->printForm();
		
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
<b>По данному полису включены следующие риски:</b><br>
<ul>
<li>Смерть застрахованного в результе несчастного случая</li>
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

        $bvForm = new form();
        $bvForm->setAction("index.php?action=calc&type=2&step=3");
        $bvForm->setMethod("POST");

        //block insured
        $bvForm->putNewBlock('Основная информация', 'grid');
        $bvForm->addInput(new input('insurant[name]', 'text', 'Страхователь:', $formData['name'], 'text_input long', 3));
        $bvForm->addInput(new input('insurant[region]', 'text', 'Адрес регистрации:', $formData['region'], 'text_input long', 3));
        $bvForm->addInput(new input('insurant[city]', 'text', ' ', $formData['city'], 'text_input long', 3));
        $bvForm->addInput(new input('insurant[street]', 'text', ' ', $formData['street'], 'text_input long', 3));
        $bvForm->addInput(new input('insurant[house]', 'text', ' ', $formData['house'], 'text_input short', 1));
        $bvForm->addInput(new input('insurant[housing]', 'text', null, $formData['housing'], 'text_input short', 1));
        $bvForm->addInput(new input('insurant[apartment]', 'text', null, $formData['apartment'], 'text_input short', 1));
        $bvForm->addInput(new input('insurant[passportSeries]', 'text', 'Паспорт:', $formData['passportSeries'], 'text_input short', 1));
        $bvForm->addInput(new input('insurant[passportNumber]', 'text', null, $formData['passportNumber'], 'text_input double', 2));		
		$bvForm->addInput(new input('insurant[birthday]', 'dataPicker', 'Дата рождения:', $formData['birthday'], 'text_input', 3));
        $bvForm->addInput(new input('insurant[phone]', 'text', 'Телефон:', $formData['phone'], 'text_input short', 1));

        //block territory of insure
        if (isset($_SESSION['calc']['bellaVitaInsured']))
            $formData = $_SESSION['calc']['bellaVitaInsured'];
        else
        {
            global $defaultValues;
            $formData = $defaultValues['calc']['bellaVitaInsured'];
        }
        $bvForm->putNewBlock('Территория страхования', 'grid');
		$bvForm->addInput(new input('', 'isCheckbox', ' ', 'Страхователь является застрахованным', 'boxCheckbox', 3));
		$bvForm->addInput(new input('bellaVitaInsured[name]', 'text', 'ФИО:', $formData['name'], 'text_input long', 3));
        $bvForm->addInput(new input('bellaVitaInsured[region]', 'text', 'Область или край:', $formData['region'], 'text_input long', 3));
        $bvForm->addInput(new input('bellaVitaInsured[city]', 'text', 'Город:', $formData['city'], 'text_input long', 3));
        $bvForm->addInput(new input('bellaVitaInsured[street]', 'text', 'Улица:', $formData['street'], 'text_input long', 3));
        $bvForm->addInput(new input('bellaVitaInsured[house]', 'text', 'Дом / Корпус', $formData['house'], 'text_input short', 1));
        $bvForm->addInput(new input('bellaVitaInsured[housing]', 'text', null, $formData['housing'], 'text_input short', 1));

        //beneficiary block
        if (isset($_SESSION['calc']['bellaVitaBeneficiary']))
            $formData = $_SESSION['calc']['bellaVitaBeneficiary'];
        else
        {
            global $defaultValues;
            $formData = $defaultValues['calc']['bellaVitaBeneficiary'];
        }
        $bvForm->putNewBlock('Выгодоприобретатель', 'grid');
		$bvForm->addInput(new input('bellaVitaInsured[beneficiary]', 'isCheckbox', ' ', 'Страхователь является выгодоприобретателем страхуемого имущества', 'boxCheckbox', 3));
        $bvForm->addInput(new input('bellaVitaBeneficiary[name]', 'text', 'ФИО:', $formData['name'], 'text_input long', 3));       
        $bvForm->addInput(new input('bellaVitaBeneficiary[birthday]', 'dataPicker', 'Дата рождения:', $formData['birthday'], 'text_input', 3));
        $bvForm->addInput(new input('sendbellaVita', 'submit', null, 'Далее', 'btn next', 4));
        $bvForm->printForm();
        break;
    case 3:
        $bvForm = new form();
        $bvForm->setAction("index.php?action=calc&type=2&step=4");
        $bvForm->setMethod("POST");

        //block insured
        $bvForm->addInput(new input('', 'custom', null, '<b class="warning">ОБРАТИТЕ ВНИМАНИЕ, ЧТО ПОЛИС ВСТУПАЕТ В СИЛУ ТОЛЬКО НА 5-е СУТКИ ПОСЛЕ ОПЛАТЫ</b>', '', 4));
        $bvForm->putNewBlock('Выберите вариант рассрочки платежа:', 'grid');
        $bvForm->addInput(new input('payType', 'radio', 'Единовременный платеж', '', 'boxRadio', 3));
        $bvForm->addInput(new input('payType', 'radio', 'Рассрочка на 2 равных платежа в течение 3-х месяцев', '', 'boxRadio', 3));
        $bvForm->addInput(new input('payType', 'radio', 'Рассрочка на 2 равных платежа в течение 6-ти месяцев', '', 'boxRadio', 3));
        $bvForm->addInput(new input('payType', 'radio', 'Рассрочка на 4 равных платежа каждые 3 месяца', '', 'boxRadio', 3));
        $bvForm->addInput(new input('payType', 'radio', 'Рассрочка на 12 равных платежа каждый месяц', '', 'boxRadio', 3));
        $bvForm->addInput(new input('payType', 'radio', 'Ежедневная рассрочка платежей', '', 'boxRadio', 3));
		$bvForm->addInput(new input('', 'custom', null, '<span style="margin-left:25px;">Введите ПРОМОКОД для получения скидки:</span>', '', 2));
		$bvForm->addInput(new input('payType[promo]', 'text', null, $formData['name'], 'text_input short', 1));
		$bvForm->addInput(new input('payType[0][type]', 'checkbox', 'С <a href="#">Правилами страхования</a> и <a href="#">Полисными условиями</a> ознакомлен', '', 'boxCheckbox', 3));		
        $bvForm->addInput(new input('sendVillaggio', 'submit', null, 'Далее', 'btn next', 4));
        $bvForm->printForm();
		
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
