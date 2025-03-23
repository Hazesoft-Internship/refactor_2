<?php

namespace App\Views;

class DisplayStudentReport {
    public function displayStudentReport($studentId)
    {
        global $students;

        // Find the student
        $studentIndex = -1;
        foreach ($students as $index => $student) {
            if ($student['id'] == $studentId) {
                $studentIndex = $index;
                break;
            }
        }

        if ($studentIndex == -1) {
            echo "Error: Student not found.<br>";
            return;
        }

        $student = $students[$studentIndex];
        $gpa = calculateGPA($studentId);

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
}