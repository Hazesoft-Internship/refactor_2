<?php

require_once "grading.php";

class DisplayStatistics 
{

    public function findStudent($studentId): int
    {
        global $students;
        $studentIndex = -1;
        foreach ($students as $index => $student) {
            if ($student['id'] == $studentId) {
                return $index;
            }
        }
    }
    public function displayStudentReport($studentId) {
        global $students;
    
        // Find the student
        $studentIndex = $this->findStudent($studentId);
    
        if ($studentIndex == -1) {
            echo "Error: Student not found.<br>";
            return;
        }
    
        $student = $students[$studentIndex];
        $grade1 = new Grade();
        $gpa = $grade1->calculateGPA($studentId);
    
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

    public function getSystemStatistics() 
    {
        global $students;
    
        $totalStudents = count($students);
        $studentsWithCourses = 0;
        $totalCourseEnrollments = 0;
    
        foreach ($students as $student) {
            if (!empty($student['courses'])) {
                $studentsWithCourses++;
                $totalCourseEnrollments += count($student['courses']);
            }
        }
    
        echo "<br>====== System Statistics ======<br>";
        echo "Total Students: {$totalStudents}<br>";
        echo "Students with Courses: {$studentsWithCourses}<br>";
        echo "Total Course Enrollments: {$totalCourseEnrollments}<br>";
        echo "Total Grades Assigned: " .Grade::$totalGradesAssigned ."<br>";
        echo "Total Students Processed: ".Grade::$totalStudentsProcessed ."<br>";
        echo "==============================<br>";
    }
}