<?php

//print_r ($_POST);
switch ($GLOBALS['calc']) {
    case 'villaggio':
        $coefficients = dbGetCoefficientsForCalc(array('calc' => 0));
        break;
    case 'feliceCitta':
        $coefficients = dbGetCoefficientsForCalc(array('calc' => 1));
        break;
    case 'bellaVita':
        $coefficients = dbGetCoefficientsForCalc(array('calc' => 2));
        break;
    case 'bellissimo':
        $coefficients = dbGetCoefficientsForCalc(array('calc' => 3));
        break;
    default:
        $coefficients = null;

}

print_r ($coefficients);


if ($GLOBALS['calc'] == 'main')
{

}
else
{

?>


    <div class="hero-unit">
        <h2>Коэффициенты</h2>
        <form class="form-horizontal" action="/admin/index.php?p=coefficient&calc=villaggio" method="POST">
            <?php
                foreach ($coefficients as $coefficient) {
                    $param = '';
                    if ($coefficient['param'] != '')
                        $param = "[{$coefficient['param']}]";
                    echo '<div class="control-group">';
                    echo "<label class=\"control-label\" for=\" {$coefficient['id']} \">{$coefficient['name']}{$param} = </label>";
                    echo "<div class=\"controls\"><input type=text id=\"{$coefficient['id']}\" name=\"coeff[{$coefficient['id']}]\" value=\"{$coefficient['value']}\"> {$coefficient['longName']}</div>";
                    echo '</div>';
                }
                ?>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary" name="saveVillaggioCoefficient" value="1">Обновить</button>
              <button type="button" class="btn">Отменить (работу кнопки не проверял!!!)</button>
            </div>
        </form>
    </div>


<?php
}
?>
