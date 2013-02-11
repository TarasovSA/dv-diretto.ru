<?php
if (!isset($_REQUEST['zone']))
{
    if (!isset($_REQUEST['action']))
    {
        if (!isset($_REQUEST['page']))
        {
?>

<table class="select_table" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td><!--<a href="/index.php?action=calc&type=0">--><img src="/images/viillagio_grey.png" width="396" height="250" border="0" alt="Villagio - Страхование загородных строений" title="Villagio - Страхование загородных строений"/></td>
        <td><!--<a href="/index.php?action=calc&type=1">--><img src="/images/felice_citta_grey.png" width="396" height="250" border="0" alt="Felice Cita - Страхование квартиры" title="Felice Cita - Страхование квартиры"/></td>
    </tr>
    <tr>
        <td><!--<a href="/index.php?action=calc&type=2">--><img src="/images/bella_vita_grey.png" width="396" height="250" border="0" alt="Bella Vita - Страхование жизни" title="Bella Vita - Страхование жизни"/></td>
        <td><a href="/index.php?action=calc&type=3"><img src="/images/bellissimo.png" width="396" height="250" border="0" alt="Belissimo - Страхование КАСКО" title="Belissimo - Страхование КАСКО"/></a></td>
    </tr>
</table>

        <?php
        }
        elseif (isset($_REQUEST['page']))
        {
            include_once('pages.php');
        }
    }
    elseif ($_REQUEST['action'] == 'calc')
    {
        include_once("calc.php");
    }
    elseif ($_REQUEST['action'] == 'reg')
    {
        include_once("registration.php");
    }
    elseif ($_REQUEST['action'] == 'login')
    {
        include_once("login.php");
    }
}
elseif ($_REQUEST['zone'] == 'private')
{
    if (!isset($_REQUEST['action']))
    {
?>

        <table width="100%" border="1">
            <tr>
                <td width="50%" height="300">
                    <a href="/index.php?zone=private&action=policies">My Policies</a>
                </td>
                <td width="50%" height="300">
                    <a href="/index.php?zone=private&action=graphs">Graphs</a>
                </td>
            </tr>
            <tr>
                <td width="50%" height="300" colspan="2">
                    <a href="/index.php?zone=private&action=privileges">Privileges</a>
                </td>
            </tr>
        </table>

<?php
    }
}


