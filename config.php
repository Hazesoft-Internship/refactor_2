<?php
// config.php
require_once __DIR__ . '/vendor/autoload.php';

use suyas\refactor_2\Model\Student;
use suyas\refactor_2\Model\Course;
use suyas\refactor_2\Controller\GradeController;
use suyas\refactor_2\View\ReportView;
use suyas\refactor_2\View\StatisticsView;

header('Content-Type: text/html; charset=utf-8');
?>