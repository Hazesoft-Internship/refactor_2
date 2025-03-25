<?php
require_once 'Repository/StudentRepository.php';

use Repository\StudentRepository;
use Repository\CourseRepository;
use function Repository\seedData;

$studentRepo = new StudentRepository();
$courseRepo = new CourseRepository();
seedData($studentRepo, $courseRepo);

$totalStudents = count($studentRepo->students);
$studentsWithCourses = count(array_filter($studentRepo->students, fn($s) => !empty($s->courses)));
$totalCourseEnrollments = array_sum(array_map(fn($s) => count($s->courses), $studentRepo->students));
$totalGradesAssigned = $totalCourseEnrollments;
$totalStudentsProcessed = $studentsWithCourses;

echo "<br>====== System Statistics ======<br>";
echo "Total Students: {$totalStudents}<br>";
echo "Students with Courses: {$studentsWithCourses}<br>";
echo "Total Course Enrollments: {$totalCourseEnrollments}<br>";
echo "Total Grades Assigned: {$totalGradesAssigned}<br>";
echo "Total Students Processed: {$totalStudentsProcessed}<br>";
echo "==============================<br>";

echo "<a href='index.php'>Back to Dashboard</a><br>";
echo "<a href='StudentReport.php'>View Student Report</a>";
