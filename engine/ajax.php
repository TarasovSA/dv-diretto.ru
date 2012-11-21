<?php
include_once ('session.php');
include_once ('dbOperations.php');
function getModels($type)
{
    $carsModels = dbGetCarsModelsByMark(array('idMark' => $type));

    $firstLetter = null;
    foreach ($carsModels as $id => $carModel)
    {
        if ($firstLetter == null OR $firstLetter != mb_substr($carModel,0,1,'UTF-8'))
        {
            if ($firstLetter != null)
                echo '</ul></br>';
            $firstLetter = mb_substr($carModel,0,1,'UTF-8');
            echo "<h3 class='orange inline'>{$firstLetter}</h3>";
            echo "<ul><li><a href='#' onclick='selectCarModel({$id}, \"{$carModel}\")' style='text-decoration: underline;'>{$carModel}</a></li>";
        }
        else
            echo "<li><a href='#' onclick='selectCarModel({$id}, \"{$carModel}\")' style='text-decoration: underline;'>{$carModel}</a></li>";
    }
    echo '</ul>';
}

function getModifications($model, $year)
{
    $carsModifications = dbGetCarsModificationsByModel(array('idModel' => $model, 'year' => $year));

    $firstLetter = null;
    foreach ($carsModifications as $id => $carModification)
    {
        if ($firstLetter == null OR $firstLetter != mb_substr($carModification['modificationName'],0,1,'UTF-8'))
        {
            if ($firstLetter != null)
                echo '</ul></br>';
            $firstLetter = mb_substr($carModification['modificationName'],0,1,'UTF-8');
            echo "<h3 class='orange inline'>{$firstLetter}</h3>";
            echo "<ul><li><a href='#' onclick='selectCarModification({$id}, \"{$carModification['modificationName']}\", \"{$carModification['cost']}\")' style='text-decoration: underline;'>{$carModification['modificationName']}</a></li>";
        }
        else
            echo "<li><a href='#' onclick='selectCarModification({$id}, \"{$carModification['modificationName']}\", \"{$carModification['cost']}\")' style='text-decoration: underline;'>{$carModification['modificationName']}</a></li>";
    }
    echo '</ul>';
}

function getSession()
{
    echo json_encode(array('session' => $_SESSION, 'cars' => dbGetCars()));
}

function getCars()
{
    echo json_encode(dbGetCars());
}

if ($_GET['get'] == 'getModels')
{
    getModels($_GET['type']);
}
elseif ($_GET['get'] == 'getModifications')
{
    getModifications($_GET['model'], $_GET['year']);
}
elseif ($_GET['get'] == 'session')
{
    getSession();
}
elseif ($_GET['get'] == 'cars')
{
    getCars();
}