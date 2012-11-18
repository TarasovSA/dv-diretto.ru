<?php
include_once ('session.php');
include_once ('dbOperations.php');
function getModels($type)
{
    echo json_encode(dbGetCarsModelsByMark(array('idMark' => $type)));
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
elseif ($_GET['get'] == 'session')
{
    getSession();
}
elseif ($_GET['get'] == 'cars')
{
    getCars();
}