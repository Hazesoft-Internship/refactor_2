<?php

use Refactor2\Controllers\Statistics;
use Refactor2\Controllers\StudentController;

include 'Controllers/StudentController.php';
include 'Controllers/StatisticsController.php';

$student = new StudentController();
$statistics = new Statistics();

function runDemo()
{
    // Add some grades
    global $student, $statistics;

    $student->addGrade(1, 'CS101', 85);
    $student->addGrade(1, 'MATH101', 92);
    $student->addGrade(2, 'CS201', 78);
    $student->addGrade(3, 'ENG101', 65);
    $student->addGrade(3, 'CS101', 72);
    $student->addGrade(4, 'CS201', 95);


    // Display student reports
    $student->displayStudentReport(1);
    $student->displayStudentReport(2);
    $student->displayStudentReport(3);
    $student->displayStudentReport(4);

    // Show system statistics
    $statistics->getSystemStatistics();
}

// Run the demo
runDemo();
