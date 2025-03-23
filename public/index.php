<?php

require_once('../app/controllers/AddGrade.php');
require_once('../app/views/DisplayStudentReport.php');
require_once('../app/views/GetSystemStatistics.php');
require_once('../app/views/RunDemo.php');
require_once(__DIR__ . '/../config/coursesdb.php');
require_once(__DIR__ . '/../config/studentsdb.php');

use App\Controllers\AddGrade;
use App\Views\DisplayStudentReport;
use App\Views\GetSystemStatistics;
use App\Views\RunDemo;

// class instantiation
$addGrade = new AddGrade();
$displayStudentReport = new DisplayStudentReport();
$getSystemStatistics = new GetSystemStatistics();
$runDemo = new RunDemo();

// run demo
$runDemo->runDemo();







