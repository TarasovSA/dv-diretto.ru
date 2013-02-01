<?php
//error_reporting(E_ALL);
error_reporting(0);
include_once ('engine/session.php');
include_once ('engine/dbOperations.php');
include_once ('engine/defaultValues.php');
include_once ('engine/form.php');
include_once ('engine/auxiliaryFunctions.php');
include_once ('engine/buttonReaction.php');


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Dolce Vita</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/themes/custom-theme/jquery-ui-1.9.0.custom.min.css">
    <script type="text/javascript" language="javascript" src="js/style_js.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" language="javascript" src="/js/calcs.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            if (!$.browser.opera) {

                // select element styling
                $('select.select').each(function () {
                    var title = $(this).attr('title');
                    if ($('option:selected', this).val() != '') title = $('option:selected', this).text();
                    $(this)
                            .css({'z-index':10, 'opacity':0, '-khtml-appearance':'none'})
                            .after('<span class="select">' + title + '</span>')
                            .change(function () {
                                val = $('option:selected', this).text();
                                $(this).next().text(val);
                            })
                });

            }
            ;

        });
    </script>
</head>

<body onload="ConvertAllCheckbox();ConvertAllRadio();">
<?php include_once('blocks/modalWindows.php'); ?>
<div id="top_bg">&nbsp;</div>
<table id="main" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="top_menu_bg">
        <td id="logo_td" valign="top"><a href="/"><img src="images/logo.png" width="165" height="69" border="0"/></a>
        </td>
        <td id="top_menu_td" valign="top">

            <ul id="top_menu">
                <li><a href="/?action=calc&type=0">Villagio</a></li>
                <li><a href="/?action=calc&type=1">Felice Citta</a></li>
                <li><a href="/?action=calc&type=2">Bella Vita</a></li>
                <li><a href="/?action=calc&type=3">Bellissimo</a></li>
                <?php
                if (isset($_SESSION['idUser']))
                    echo "<li class=\"activ\"><a href=\"/?action=reg\">Регистрация</a></li>";
                else
                    echo "<li class=\"activ\"><a href='#' onclick='login();'>Личный кабинет</a></li>";
                ?>

            </ul>
        </td>
    </tr>
    <tr>
        <td colspan="2" id="content_td" class="<?=selectContentBg(); ?>" valign="top">
            <!-- Контент начало -->

            <?php include_once ("blocks/content.php");?>

            <!-- Контент конец -->
        </td>
    </tr>
    <tr>
        <td colspan="2" id="clear_td" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" id="bottom_td" valign="top">
            <div class="copy_right"><p>&copy; All Rights Reserved. www.dv-diretto.ru 2012</p></div>
            <ul id="bottom_menu">
                <li><a href="#">О проекте</a></li>
                <li><a href="#">Контакты</a></li>
                <li><a href="#">Разработчики</a></li>
            </ul>
        </td>
    </tr>
</table>
</body>
</html>