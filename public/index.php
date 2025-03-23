<?php

require_once ('../app/controllers/addgrade.php');
//require_once '../app/controllers/calculategpa.php';
//require_once '../app/controllers/calculatelettergrade.php';
require_once ('../app/views/displaystudentreport.php');
require_once ('../app/views/getsystemstatistics.php');
require_once ('../app/views/rundemo.php');
require_once (__DIR__ . '/../config/coursesdb.php');
require_once (__DIR__ . '/../config/studentsdb.php');

use App\Controllers\AddGrade;
use App\Controllers\CalculateGPA;
use App\Controllers\CalculateLetterGrade;
use App\Views\DisplayStudentReport;
use App\Views\GetSystemStatistics;
use App\Views\RunDemo;

// global stats
$totalGradesAssigned = 0;
$totalStudentsProcessed = 0;

// class instantiation
$addGrade = new AddGrade();
//$calculateGPA = new CalculateGPA();
//$calculateLetterGrade = new CalculateLetterGrade();
$displayStudentReport = new DisplayStudentReport();
$getSystemStatistics = new GetSystemStatistics();
$runDemo = new RunDemo();

// run demo
$runDemo->runDemo();







