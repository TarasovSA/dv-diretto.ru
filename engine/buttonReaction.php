<?php

function addNewUser()
{
    $structure = $_REQUEST['user'];
    $structure['salt'] = uniqid();
    $structure['password'] = md5(md5($structure['password']).md5('salt'));
    $result = dbAddNewUser($structure);
    return $result;
}

function addBellaVitaCalcData($step)
{
    switch ($step){
        case 1:
            if(isset($_REQUEST['bellaVita']))
                $_SESSION['calc']['bellaVita'] = $_REQUEST['bellaVita'];
            break;
        case 2:
            $_SESSION['calc']['insurant'] = $_REQUEST['insurant'];
            $_SESSION['calc']['bellaVitaInsured'] = $_REQUEST['bellaVitaInsured'];
            $_SESSION['calc']['bellaVitaBeneficiary'] = $_REQUEST['bellaVitaBeneficiary'];
            break;
        default:
            $structure = null;
            break;
    }
}

function addFeliceCittaCalcData($step)
{
    if(isset($_REQUEST['villaggio']));
    switch ($step){
        case 1:
            if(isset($_REQUEST['feliceCitta']))
                $_SESSION['calc']['feliceCitta'] = $_REQUEST['feliceCitta'];
            break;
        case 2:
            $_SESSION['calc']['insurant'] = $_REQUEST['insurant'];
            $_SESSION['calc']['feliceCittaTerritory'] = $_REQUEST['feliceCittaTerritory'];
            $_SESSION['calc']['beneficiary'] = $_REQUEST['beneficiary'];
            break;
        default:
            $structure = null;
            break;
    }
}


function addVillaggioCalcData($step)
{
    switch ($step){
        case 1:
            if(isset($_REQUEST['villaggio']))
                $_SESSION['calc']['villaggio'] = $_REQUEST['villaggio'];
                $_SESSION['calc']['villaggioAdditionalStruct'] = $_POST['villaggioAdditionalStruct'];
            break;
        case 2:
            $_SESSION['calc']['insurant'] = $_REQUEST['insurant'];
            $_SESSION['calc']['villaggioTerritory'] = $_REQUEST['villaggioTerritory'];
            $_SESSION['calc']['beneficiary'] = $_REQUEST['beneficiary'];
            break;
        default:
            $structure = null;
            break;
    }
}

function addBellissimoData($step)
{
    switch ($step){
        case 1:
            if(isset($_REQUEST['bellissimo']))
            {
                $_SESSION['calc']['bellissimo'] = $_REQUEST['bellissimo'];
                $_SESSION['calc']['bellissimoDrivers'] = $_REQUEST['bellissimoDrivers'];
                $_SESSION['calc']['bellissimoOthers'] = $_REQUEST['bellissimoOthers'];
            }
            break;
        case 2:
            $_SESSION['calc']['bellissimoAdditional'] = $_REQUEST['bellissimoAdditional'];
            $_SESSION['calc']['bellissimoMaintenance'] = $_REQUEST['bellissimoMaintenance'];
            $_SESSION['calc']['bellissimoDiscount'] = $_REQUEST['bellissimoDiscount'];
            break;
        case 2:
            $_SESSION['calc']['insurant'] = $_REQUEST['insurant'];
            $_SESSION['calc']['bellissimoBeneficiary'] = $_REQUEST['bellissimoBeneficiary'];
            $_SESSION['calc']['bellissimoAutoInfo'] = $_REQUEST['bellissimoAutoInfo'];
            $_SESSION['calc']['bellissimoAddressCheck'] = $_REQUEST['bellissimoAddressCheck'];
            break;
        default:
            $structure = null;
            break;
    }
}


function getUserId()
{
    $structure['login'] = $_REQUEST['login'];
    $structure['password'] = $_REQUEST['password'];
    $result = dbGetUserId($structure);
    return $result;
}



if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'calc')
{
    if (isset($_REQUEST['type']) && $_REQUEST['type'] == 0)
    {
        if (isset($_REQUEST['step']))
        {
            addVillaggioCalcData($_REQUEST['step']-1);
        }
    }
    elseif (isset($_REQUEST['type']) && $_REQUEST['type'] == 1)
    {
        if (isset($_REQUEST['step']))
        {
            addFeliceCittaCalcData($_REQUEST['step']-1);
        }
    }
    elseif (isset($_REQUEST['type']) && $_REQUEST['type'] == 2)
    {
        if (isset($_REQUEST['step']))
        {
            addBellaVitaCalcData($_REQUEST['step']-1);
        }
    }
    elseif (isset($_REQUEST['type']) && $_REQUEST['type'] == 3)
    {
        if (isset($_REQUEST['step']))
        {
            addBellissimoData($_REQUEST['step']-1);
        }
    }
}
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reg')
{
    if (isset($_REQUEST['step']) && $_REQUEST['step'] == 2)
    {
        $result = addNewUser();
        if ($result == 0)
            echo "Такой пользователь уже существует";
        else
            echo "Вы успешно зарегистрированны";
    }
}
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'login')
{
    if (isset($_REQUEST['step']) && $_REQUEST['step'] == 2)
    {
        $result = getUserId();
        if ($result != 0)
        {
            $_SESSION['idUser'] = $result;
            echo "Вы успешно залогинились";
        }
        else
            echo "Не найден пользователь с таким логином и паролем";

    }
}