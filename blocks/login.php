<?php
//print_r($_REQUEST);
global $defaultValues;
if (isset($_REQUEST['step']))
    $step = $_REQUEST['step'];
else
    $step = 1;




if ($step == 1)
{
    $villaggioForm = new form();
    $villaggioForm->setAction("index.php?action=login&type=0&step=2");
    $villaggioForm->setMethod("POST");

    //block insured
    $villaggioForm->setNameCurrentBlock('Логин и пароль');
    $villaggioForm->addInput(new input('login', 'text', 'Login:', ''));
    $villaggioForm->addInput(new input('password', 'password', 'Password', ''));

    $villaggioForm->addInput(new input('sendLogin', 'submit', '', 'Войти'));
    $villaggioForm->printForm();
}

