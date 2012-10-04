<?php

$GLOBALS['page'] = null;
if (isset($_GET['p']))
    $GLOBALS['page'] = $_GET['p'];
else
    $GLOBALS['page'] = 'main';

$GLOBALS['calc'] = null;

if (isset($_GET['calc']))
    $GLOBALS['calc'] = $_GET['calc'];
else
    $GLOBALS['calc'] = 'main';