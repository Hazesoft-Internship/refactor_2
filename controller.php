<?php

require_once "grading.php";
require_once "displayStats.php";

$grade1 = new Grade();
$grade1->addGrade(1, 'CS101', 85);
$grade1->addGrade(1, 'MATH101', 92);
$grade1->addGrade(2, 'CS201', 78);
$grade1->addGrade(3, 'ENG101', 65);
$grade1->addGrade(3, 'CS101', 72);
$grade1->addGrade(4, 'CS201', 95);

// Display student reports
$displayStats1 = new DisplayStatistics();
$displayStats1->displayStudentReport(1);
$displayStats1->displayStudentReport(2);
$displayStats1->displayStudentReport(3);
$displayStats1->displayStudentReport(4);

// Show system statistics
$displayStats1->getSystemStatistics();