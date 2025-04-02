<?php

require __DIR__ . '/../vendor/autoload.php';

use Weave\Refactor2\Repository\StudentRepository;

StudentRepository::initialize();

echo "<br>====== System Statistics ======<br>";
echo "Total Students: " . StudentRepository::getTotalStudents() . "<br>";
echo "Students with Courses: " . StudentRepository::getStudentsWithCourses() . "<br>";
echo "Total Course Enrollments: " . StudentRepository::getTotalCourseEnrollments() . "<br>";
echo "Total Grades Assigned: " . StudentRepository::getTotalGradesAssigned() . "<br>";
echo "Total Students Processed: " . StudentRepository::getTotalStudentsProcessed() . "<br>";
echo "==============================<br>";

echo "<a href='index.php'>Back to Dashboard</a><br>";
echo "<a href='StudentReport.php'>View Student Report</a>";
