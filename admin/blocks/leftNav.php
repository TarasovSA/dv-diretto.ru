<?php


switch ($GLOBALS['page'])
{
    case 'coefficient':
        include_once ('navCoefficient.php');
        break;
    default:
        include_once ('navMain.php');
}