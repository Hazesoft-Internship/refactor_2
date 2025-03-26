<?php
// config.php
require_once 'Model/Student.php';
require_once 'Model/Course.php';
require_once 'Grading/GradingStrategy.php';
require_once 'View/ReportView.php';
require_once 'View/StatisticsView.php';
require_once 'Controller/GradeController.php';

header('Content-Type: text/html; charset=utf-8');
?>