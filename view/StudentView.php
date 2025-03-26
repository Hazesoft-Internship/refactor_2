<?php

namespace View;

use Model\Student;

require_once '../model/Student.php';

class StudentView
{
    public static function displayStudentReport(Student $student, $gpa): void
    {
        echo "<br>====== Student Report ======<br>";
        echo "ID: " . $student->getId() . "<br>";
        echo "Name: " . $student->getName() . "<br>";
        echo "Type: " . $student->getType() . "<br>";
        echo "GPA: " . $gpa . "<br>";
        echo "Courses:<br>";

        $grades = $student->getGrades();
        if (empty($grades)) {
            echo "No courses registered.<br>";
        } else {
            foreach ($grades as $gradeRecord) {
                $course = $gradeRecord->getCourse();
                echo "- " . $course->getCode() . ": Score = " . $gradeRecord->getScore() .
                    ", Grade = " . $gradeRecord->getLetterGrade() . "<br>";
            }
        }
        echo "==========================<br>";
    }

    public static function displaySystemStatistics($totalStudents, 
                                                $studentsWithCourses, 
                                                $totalCourseEnrollments, 
                                                $totalGradesAssigned, 
                                                $totalStudentsProcessed
                                                ): void 
    {
        echo "<br>====== System Statistics ======<br>";
        echo "Total Students: {$totalStudents}<br>";
        echo "Students with Courses: {$studentsWithCourses}<br>";
        echo "Total Course Enrollments: {$totalCourseEnrollments}<br>";
        echo "Total Grades Assigned: {$totalGradesAssigned}<br>";
        echo "Total Students Processed: {$totalStudentsProcessed}<br>";
        echo "==============================<br>";
    }
}