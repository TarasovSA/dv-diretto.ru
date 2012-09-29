<?php
//print_r($_REQUEST);
global $defaultValues;
if (isset($_REQUEST['step']))
    $step = $_REQUEST['step'];
else
    $step = 1;


if ($step == 1)
{
    if (isset($_SESSION['registration']['user']))
        $formData = $_SESSION['registration']['user'];
    else
        $formData = $defaultValues['registration']['user'];

    $villaggioForm = new form();
    $villaggioForm->setAction("index.php?action=reg&step=2");
    $villaggioForm->setMethod("POST");

    //block insured
    $villaggioForm->setNameCurrentBlock('Информация о пользователе');
    $villaggioForm->addInput(new input('user[name]', 'text', 'ФИО', $formData['name'], 'text_input long'));
    $villaggioForm->addInput(new input('user[login]', 'text', 'Логин', $formData['login'], 'text_input double'));
    $villaggioForm->addInput(new input('user[password]', 'password', 'Пароль', '', 'text_input double'));
    $villaggioForm->addInput(new input('user[email]', 'text', 'e-mail', $formData['email'], 'text_input double'));
    $villaggioForm->addInput(new input('user[region]', 'text', 'Область или край', $formData['region'], 'text_input long'));
    $villaggioForm->addInput(new input('user[city]', 'text', 'Город', $formData['city'], 'text_input long'));
    $villaggioForm->addInput(new input('user[street]', 'text', 'улица', $formData['street'], 'text_input long'));
    $villaggioForm->addInput(new input('user[house]', 'text', 'дом', $formData['house'], 'text_input short'));
    $villaggioForm->addInput(new input('user[housing]', 'text', 'корп/стр.', $formData['housing'], 'text_input short'));
    $villaggioForm->addInput(new input('user[apartment]', 'text', 'квартира', $formData['apartment'], 'text_input short'));
    $villaggioForm->addInput(new input('user[passportSeries]', 'text', 'паспорт (серия)', $formData['passportSeries'], 'text_input double'));
    $villaggioForm->addInput(new input('user[passportNumber]', 'text', 'паспорт (номер)', $formData['passportNumber'], 'text_input double'));
    $villaggioForm->addInput(new input('user[birthday]', 'text', 'д/р', $formData['birthday'], 'text_input short'));
    $villaggioForm->addInput(new input('user[phone]', 'text', 'телефон', $formData['phone'], 'text_input short'));

    $villaggioForm->addInput(new input('userRegistration', 'submit', '', 'Зарегистрироваться', 'btn next'));
    $villaggioForm->printForm();
}
