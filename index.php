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
    <title>Итальянский страховой дом "Дольче Вита" || "Dolce Vita"</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="wot-verification" content="ed402a3db8279a6a2b70"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/themes/custom-theme/jquery-ui-1.9.0.custom.min.css">
    <link rel="stylesheet" href="css/formValidation/validationEngine.jquery.css" type="text/css"/>
    <script type="text/javascript" language="javascript" src="js/style_js.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" language="javascript" src="/js/calcs.js"></script>
    <script src="js/formValidation/languages/jquery.validationEngine-ru.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/formValidation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/masks/jquery.maskedinput-1.2.2.js" type="text/javascript" charset="utf-8"></script>

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
            <span class="phone">+7 (495) 649-02-49</span>
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
                <li><a href="index.php?page=aboutProject">О проекте</a></li>
                <li><a href="index.php?page=contacts">Контакты</a></li>
                <!--<li><a href="#">Разработчики</a></li>-->
            </ul>
        </td>
    </tr>
</table>
<script>
    jQuery(document).ready(function(){
        // binds form submission and fields to the validation engine
        jQuery("#bellissimoPrimary").validationEngine();
        jQuery("#bellissimoCourier").validationEngine();
    });

</script>
<script>
    jQuery(function($){
        $("#contactInfo\\[phone\\]").mask("+9 (999) 999-9999");
    });

</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-38352947-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter19968205 = new Ya.Metrika({id:19968205,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/19968205" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>