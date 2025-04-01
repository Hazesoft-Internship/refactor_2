<?php

use Hazesoft\Refactor2\Models\Student;

$statistics = Student::getStatistics();

echo "<br>====== System Statistics ======<br>";
echo "Total Students: {$statistics['totalStudents']}<br>";
echo "Students with Courses: {$statistics['studentsWithCourses']}<br>";
echo "Total Course Enrollments: {$statistics['totalEnrollments']}<br>";
echo "Total Grades Assigned: {$statistics['totalGradesAssigned']}<br>";
echo "Total Students Processed: {$statistics['totalStudentsProcessed']}<br>";
echo "==============================<br>";
