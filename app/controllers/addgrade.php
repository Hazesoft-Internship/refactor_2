<?php

namespace App\Controllers;

require_once(__DIR__ . '/../../config/studentsdb.php');
require_once(__DIR__ . '/../../config/coursesdb.php');
require_once(__DIR__ . '/../models/findstudentinfo.php');
require_once('calculatelettergrade.php');

use App\Controllers\CalculateLetterGrade;
use App\Models\FindStudentInfo;

$calculateLetterGrade = new CalculateLetterGrade();
$findStudentInfo = new FindStudentInfo();

class AddGrade
{
    // Function to add a grade for a student in a course
    public function addGrade($studentId, $courseCode, $score)
    {
        global $students, $totalGradesAssigned;
        global $calculateLetterGrade, $findStudentInfo;

        // Find the student
        $studentIndex = $findStudentInfo->findStudentIndex($studentId);

        if ($studentIndex == -1) {
            echo "Error: Student not found. <br>";
            return false;
        }

        // Validate score
        if ($score < 0 || $score > 100) {
            echo "Error: Score must be between 0 and 100. <br>";
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
            echo "Error: Course not found. <br>";
            return false;
        }

        // Check if student already has a grade for this course
        foreach ($students[$studentIndex]['courses'] as $index => $course) {
            if ($course['code'] == $courseCode) {
                // Update existing grade
                $students[$studentIndex]['courses'][$index]['score'] = $score;
                $students[$studentIndex]['courses'][$index]['letterGrade'] = $calculateLetterGrade->calculateLetterGrade($score, $students[$studentIndex]['type']);
                echo "Grade updated for student {$students[$studentIndex]['name']} in course {$courseCode}.<br>";
                $totalGradesAssigned++;
                return true;
            }
        }

        // Add new grade
        $students[$studentIndex]['courses'][] = [
            'code' => $courseCode,
            'score' => $score,
            'letterGrade' => $calculateLetterGrade->calculateLetterGrade($score, $students[$studentIndex]['type'])
        ];

        echo "Grade added for student {$students[$studentIndex]['name']} in course {$courseCode}. <br>";
        $totalGradesAssigned++;
        return true;
    }
}