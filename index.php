<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "./StudentReport.php";
require_once "./StudentStatistics.php";

// $addGrade= new StudentGrade();
// $addGrade->addGrade(1,"CS101",97);

$display= new StudentReport();
$display->addGrade(1,"CS101",97);
$display->displayStudentReport(1);
$display->getSystemStatistics();


// $displaySystemStats= new SystemStatistics();
// $displaySystemStats->getSystemStatistics();
?>