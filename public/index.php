<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

use Hazesoft\Refactor2\Controllers\StudentController;
 

$controller = new StudentController();
$controller->showReports();
$controller->showStatistics();




