<?php

require_once "./StudentGrade.php";

class StudentReport extends StudentGrade
{

    function displayStudentReport($studentId)
    {
        $studentIndex = Student::findStudent($studentId);



        if ($studentIndex === false) {
            echo "Error: Student not found.<br>";
            return false;
        }

        $student = $this->students[$studentIndex];
        $gpa = $this->calculateGPA($studentId);

        echo "<br>====== Student Report ======<br>";
        echo "ID: {$student['id']}<br>";
        echo "Name: {$student['name']}<br>";
        echo "Type: {$student['type']}<br>";
        echo "GPA: {$gpa}<br>";
        echo "Courses:<br>";

        if (empty($student['courses'])) {
            echo "No courses registered.<br>";
        } else {
            foreach ($student['courses'] as $course) {
                echo "- {$course['code']}: Score = {$course['score']}, Grade = {$course['letterGrade']}<br>";
            }
        }

        echo "==========================<br>";
    }



    function getSystemStatistics()
    {

        $totalStudents = count($this->students);
        $studentsWithCourses = 0;
        $totalCourseEnrollments = 0;

        foreach ($this->students as $student) {
            if (!empty($student['courses'])) {
                $studentsWithCourses++;
                $totalCourseEnrollments += count($student['courses']);
            }
        }

        $assignedGrade = StudentGrade::$totalGradesAssigned;
        $processedGrade = StudentGrade::$totalGradesAssigned;


        echo "<br>====== System Statistics ======<br>";
        echo "Total Students: {$totalStudents}<br>";
        echo "Students with Courses: {$studentsWithCourses}<br>";
        echo "Total Course Enrollments: {$totalCourseEnrollments}<br>";
        echo "Total Grades Assigned: {$assignedGrade}<br>";
        echo "Total Students Processed: {$processedGrade}<br>";
        echo "==============================<br>";
    }
}
