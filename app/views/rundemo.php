<?php

namespace App\Views;

require_once(__DIR__ . '/../controllers/addgrade.php');
require_once ('displaystudentreport.php');
require_once ('getsystemstatistics.php');

use App\Controllers\AddGrade;
use App\Views\DisplayStudentReport;
use App\Views\GetSystemStatistics;

// initializing objects
$addGrade = new AddGrade();
$displayStudentReport = new DisplayStudentReport();
$getSystemStatistics = new GetSystemStatistics();

class RunDemo {
    public function runDemo(): void
    {
        global $addGrade, $displayStudentReport, $getSystemStatistics;
        // Add some grades
        $addGrade->addGrade(1, 'CS101', 85);
        $addGrade->addGrade(1, 'MATH101', 92);
        $addGrade->addGrade(2, 'CS201', 78);
        $addGrade->addGrade(3, 'ENG101', 65);
        $addGrade->addGrade(3, 'CS101', 72);
        $addGrade->addGrade(4, 'CS201', 95);

        // Display student reports
        $displayStudentReport->displayStudentReport(1);
        $displayStudentReport->displayStudentReport(2);
        $displayStudentReport->displayStudentReport(3);
        $displayStudentReport->displayStudentReport(4);

        // Show system statistics
        $getSystemStatistics->getSystemStatistics();
    }
}
