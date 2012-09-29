<?php



// set Background Class
function selectContentBg()
{
    $types = array (0, 1, 2, 3);
    $backgroundClass = '';
    if (isset($_REQUEST['type']) AND in_array($_REQUEST['type'], $types))
    {
        switch ($_REQUEST['type'])
        {
            case 0: $backgroundClass = "_villagio"; break;
            case 1: $backgroundClass = "_felicecitta"; break;
            case 2: $backgroundClass = "_bellavita"; break;
            case 3: $backgroundClass = "_bellissimo"; break;
        }
    }
    else
        $backgroundClass = '';
    return "content_bg".$backgroundClass;
}