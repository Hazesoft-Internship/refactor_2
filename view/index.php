<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Model\UndergraduateStudent;
use Model\GraduateStudent;
use Model\PhdStudent;
use Model\Course;
use Repository\StudentRepository;
use Repository\CourseRepository;
use Controls\StudentController;

require_once '../model/UndergraduateStudent.php';
require_once '../model/GraduateStudent.php';
require_once '../model/PhdStudent.php';
require_once '../model/Course.php';
require_once '../repository/StudentRepository.php';
require_once '../repository/CourseRepository.php';
require_once '../controls/StudentController.php';

// Set header content type for proper HTML display.
header('Content-Type: text/html; charset=utf-8');

// Instantiate repositories.
$studentRepo = new StudentRepository();
$courseRepo  = new CourseRepository();

// Create student instances.
$studentRepo->addStudent(new UndergraduateStudent(1, 'John Doe'));
$studentRepo->addStudent(new GraduateStudent(2, 'Jane Smith'));
$studentRepo->addStudent(new UndergraduateStudent(3, 'Mike Johnson'));
$studentRepo->addStudent(new PhdStudent(4, 'Sarah Williams'));

// Create course instances.
$courseRepo->addCourse(new Course('CS101', 'Introduction to Programming', 3));
$courseRepo->addCourse(new Course('CS201', 'Data Structures', 4));
$courseRepo->addCourse(new Course('MATH101', 'Calculus I', 3));
$courseRepo->addCourse(new Course('ENG101', 'English Composition', 2));

// Create the controller and run the demo.
$controller = new StudentController($studentRepo, $courseRepo);
$controller->runDemo();
?>