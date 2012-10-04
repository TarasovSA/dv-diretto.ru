<?php

if (isset($_POST['saveVillaggioCoefficient']))
{
    foreach ($_POST['coeff'] as $id => $coefficient)
    {
        dbUpdateCoefficient (array('id' => $id, 'value' => $coefficient));
    }
}