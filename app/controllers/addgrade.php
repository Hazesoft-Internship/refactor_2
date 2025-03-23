<?php

namespace App\Controllers;

require_once "../../config/studentsdb.php";
require_once "../../config/coursesdb.php";

class AddGrade {
    // Function to add a grade for a student in a course
    public function addGrade($studentId, $courseCode, $score)
    {
        global $students, $totalGradesAssigned;

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
            return false;
        }

        // Validate score
        if ($score < 0 || $score > 100) {
            echo "Error: Score must be between 0 and 100.<br>";
            return false;
        }

        // Check if course exists
        $courseExists = false;
        global $courses;
        foreach ($courses as $course) {
            if ($course['code'] == $courseCode) {
                $courseExists = true;
                break;
            }
        }

        if (!$courseExists) {
            echo "Error: Course not found.<br>";
            return false;
        }

        // Check if student already has a grade for this course
        foreach ($students[$studentIndex]['courses'] as $index => $course) {
            if ($course['code'] == $courseCode) {
                // Update existing grade
                $students[$studentIndex]['courses'][$index]['score'] = $score;
                $students[$studentIndex]['courses'][$index]['letterGrade'] = calculateLetterGrade($score, $students[$studentIndex]['type']);
                echo "Grade updated for student {$students[$studentIndex]['name']} in course {$courseCode}.<br>";
                $totalGradesAssigned++;
                return true;
            }
        }

        // Add new grade
        $students[$studentIndex]['courses'][] = [
            'code' => $courseCode,
            'score' => $score,
            'letterGrade' => calculateLetterGrade($score, $students[$studentIndex]['type'])
        ];

        echo "Grade added for student {$students[$studentIndex]['name']} in course {$courseCode}.<br>";
        $totalGradesAssigned++;
        return true;
    }
}