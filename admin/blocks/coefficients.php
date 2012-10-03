<?php

$calc = null;

if (isset($_GET['calc']))
    $calc = $_GET['calc'];
else
    $calc = 'main';


switch ($calc)
{
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



?>


<div class="hero-unit">
    <h1>Коэффициенты</h1>
    <?php
    foreach ($coefficients as $coefficient)
    {
        echo $coefficient['longName'].'<input type=text name="'.$coefficient['id'].'" value="'.$coefficient['value'].'"></br>';
    }
?>

    <p>This is a template for a simple marketing or informational website. It includes a large callout
        called the hero unit and three supporting pieces of content. Use it as a starting point to create
        something more unique.</p>

    <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
</div>
<div class="row-fluid">
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
            mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
            magna mollis euismod. Donec sed odio dui. </p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <!--/span-->
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
            mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
            magna mollis euismod. Donec sed odio dui. </p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <!--/span-->
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
            mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
            magna mollis euismod. Donec sed odio dui. </p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <!--/span-->
</div>
<!--/row-->
<div class="row-fluid">
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
            mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
            magna mollis euismod. Donec sed odio dui. </p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <!--/span-->
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
            mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
            magna mollis euismod. Donec sed odio dui. </p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <!--/span-->
    <div class="span4">
        <h2>Heading</h2>

        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
            mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
            magna mollis euismod. Donec sed odio dui. </p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <!--/span-->
</div>
<!--/row-->