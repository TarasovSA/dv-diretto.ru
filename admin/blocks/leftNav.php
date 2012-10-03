<?php
if (isset($_GET['p']))
    $page = $_GET['p'];
else
    $page = 'main';

switch ($page)
{
    case 'coefficient':
        include_once ('navCoefficient.php');
        break;
    default:
        include_once ('navMain.php');
}