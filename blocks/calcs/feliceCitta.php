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
        if (isset($_SESSION['calc']['feliceCitta']))
            $formData = $_SESSION['calc']['feliceCitta'];
        else
            $formData = $defaultValues['calc']['feliceCitta'];


        $fcForm = new form();
        $fcForm->setAction("index.php?action=calc&type=1&step=2");
        $fcForm->setMethod("POST");
                
        $fcForm->putNewBlock('Квартира', 'grid g_none');
        $fcForm->addInput(new input('feliceCitta[constructionEl]', 'isSlider', 'Констрактивные элементы', $formData['constructionEl'], '', 3));
        $fcForm->addInput(new input('feliceCitta[interiorTrim]', 'isSlider', 'Внутренняя отделка', $formData['interiorTrim'], '', 3));
        $fcForm->addInput(new input('feliceCitta[engineeringSystems]', 'isSlider', 'Инженерные системы', $formData['engineeringSystems'], '', 3));
        $fcForm->addInput(new input('feliceCitta[property]', 'isSlider', 'Имущество', $formData['property'], '', 3));
        $fcForm->addInput(new input('feliceCitta[liability]', 'isSlider', 'Гражданская ответственность', $formData['liability'], '', 3));
		$fcForm->addInput(new input('feliceCittaAdditionalStruct[0][type]', 'checkbox', 'Обязательное страхование', '', 'boxCheckbox', 3));
        $fcForm->addInput(new input('sendFeliceCitta', 'submit', '', 'Далее', 'btn next', 4));
        $fcForm->printForm();
		
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

        $fcForm = new form();
        $fcForm->setAction("index.php?action=calc&type=1&step=3");
        $fcForm->setMethod("POST");

        //block insurant
        $fcForm->putNewBlock('Основная информация', 'grid');
        $fcForm->addInput(new input('insurant[name]', 'text', 'ФИО:', $formData['name'], 'text_input long', 3));
        $fcForm->addInput(new input('insurant[region]', 'text', 'Адрес регистрации:', $formData['region'], 'text_input long', 3));
        $fcForm->addInput(new input('insurant[city]', 'text', ' ', $formData['city'], 'text_input long', 3));
        $fcForm->addInput(new input('insurant[street]', 'text', ' ', $formData['street'], 'text_input long', 3));
        $fcForm->addInput(new input('insurant[house]', 'text', ' ', $formData['house'], 'text_input short', 1));
        $fcForm->addInput(new input('insurant[housing]', 'text', null, $formData['housing'], 'text_input short', 1));
        $fcForm->addInput(new input('insurant[apartment]', 'text', null, $formData['apartment'], 'text_input short', 1));
        $fcForm->addInput(new input('insurant[passportSeries]', 'text', 'Паспорт:', $formData['passportSeries'], 'text_input short', 1));
        $fcForm->addInput(new input('insurant[passportNumber]', 'text', null, $formData['passportNumber'], 'text_input double', 2));
        $fcForm->addInput(new input('insurant[birthday]', 'dataPicker', 'Дата рождения:', $formData['birthday'], 'text_input', 3));
        $fcForm->addInput(new input('insurant[phone]', 'text', 'Телефон:', $formData['phone'], 'text_input short'));

        //block territory of insure
        if (isset($_SESSION['calc']['feliceCittaTerritory']))
            $formData = $_SESSION['calc']['feliceCittaTerritory'];
        else
        {
            global $defaultValues;
            $formData = $defaultValues['calc']['feliceCittaTerritory'];
        }
        $fcForm->putNewBlock('Территория страхования','grid');
        $fcForm->addInput(new input('feliceCittaTerritory[region]', 'text', 'Адрес:', $formData['region'], 'text_input long', 3));
        $fcForm->addInput(new input('feliceCittaTerritory[city]', 'text', 'Город:', $formData['city'], 'text_input long', 3));
        $fcForm->addInput(new input('feliceCittaTerritory[street]', 'text', 'Улица:', $formData['street'], 'text_input long', 3));
        $fcForm->addInput(new input('feliceCittaTerritory[house]', 'text', 'Дом / Корпус:', $formData['house'], 'text_input short', 1));
        $fcForm->addInput(new input('feliceCittaTerritory[housing]', 'text', null, $formData['housing'], 'text_input short', 1));

        //beneficiary block
        if (isset($_SESSION['calc']['beneficiary']))
            $formData = $_SESSION['calc']['beneficiary'];
        else
        {
            global $defaultValues;
            $formData = $defaultValues['calc']['beneficiary'];
        }
        $fcForm->putNewBlock('Выгодоприобретатель', 'grid');		
		$fcForm->addInput(new input('insurant[beneficiary]', 'isCheckbox', 'Выгодоприобретатель:', 'Страхователь является выгодоприобретателем страхуемого имущества', 'boxCheckbox', 3));
        $fcForm->addInput(new input('beneficiary[name]', 'text', 'ФИО', $formData['name'], 'text_input long', 3));
        $fcForm->addInput(new input('beneficiary[birthday]', 'dataPicker', 'Дата рождения:', $formData['birthday'], 'text_input', 1));
        $fcForm->addInput(new input('', 'newLine', '', '', '', ''));
		
		
        $fcForm->addInput(new input('sendfeliceCitta', 'submit', '', 'Далее', 'btn next', 4));

        $fcForm->printForm();
        break;
    case 3:
        $fcForm = new form();
        $fcForm->setAction("index.php?action=calc&type=1&step=4");
        $fcForm->setMethod("POST");

        $fcForm->addInput(new input('', 'custom', null, '<b class="warning">ОБРАТИТЕ ВНИМАНИЕ, ЧТО ПОЛИС ВСТУПАЕТ В СИЛУ ТОЛЬКО НА 5-е СУТКИ ПОСЛЕ ОПЛАТЫ</b>', '', 4));
        $fcForm->putNewBlock('Выберите вариант рассрочки платежа:', 'grid');
        $fcForm->addInput(new input('payType', 'radio', 'Единовременный платеж', '', 'boxRadio', 3));
        $fcForm->addInput(new input('payType', 'radio', 'Рассрочка на 2 равных платежа в течение 3-х месяцев', '', 'boxRadio', 3));
        $fcForm->addInput(new input('payType', 'radio', 'Рассрочка на 2 равных платежа в течение 6-ти месяцев', '', 'boxRadio', 3));
        $fcForm->addInput(new input('payType', 'radio', 'Рассрочка на 4 равных платежа каждые 3 месяца', '', 'boxRadio', 3));
        $fcForm->addInput(new input('payType', 'radio', 'Рассрочка на 12 равных платежа каждый месяц', '', 'boxRadio', 3));
        $fcForm->addInput(new input('payType', 'radio', 'Ежедневная рассрочка платежей', '', 'boxRadio', 3));
		$fcForm->addInput(new input('', 'custom', null, '<span style="margin-left:25px;">Введите ПРОМОКОД для получения скидки:</span>', '', 2));
		$fcForm->addInput(new input('payType[promo]', 'text', null, $formData['name'], 'text_input short', 1));
		$fcForm->addInput(new input('payType[0][type]', 'checkbox', 'С <a href="#">Правилами страхования</a> и <a href="#">Полисными условиями</a> ознакомлен', '', 'boxCheckbox', 3));		
        $fcForm->addInput(new input('sendVillaggio', 'submit', '', 'Далее', 'btn next', 4));
        $fcForm->printForm();
		
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
