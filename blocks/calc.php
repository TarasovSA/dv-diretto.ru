<?php


switch ($_REQUEST['type'])
{
    case 0:
        include_once("calcs/villaggio.php");
        break;
    case 1:
        include_once("calcs/feliceCitta.php");
        break;
    case 2:
        include_once("calcs/bellaVita.php");
        break;
    case 3:
        include_once("calcs/bellissimo.php");
        break;
    default:
        echo "Вы попали куда-то не туда";
}
