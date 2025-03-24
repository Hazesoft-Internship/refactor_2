<?php

namespace App\Controllers;

require_once(__DIR__ . '/../models/FindStudentInfo.php');
require_once(__DIR__ . '/../models/FindCourseInfo.php');
require_once(__DIR__ . '/../models/AddNewGrade.php');
require_once('CalculateLetterGrade.php');

use App\Models\AddNewGrade;
use App\Controllers\CalculateLetterGrade;
use App\Models\FindStudentInfo;
use App\Models\FindCourseInfo;

$addNewGrade = new AddNewGrade();
$calculateLetterGrade = new CalculateLetterGrade();
$findStudentInfo = new FindStudentInfo();
$findCourseInfo = new FindCourseInfo();

class AddGrade
{
    // Function to add a grade for a student in a course
    public function addGrade($studentId, $courseCode, $score)
    {
        global $totalGradesAssigned;
        global $calculateLetterGrade, $findStudentInfo, $findCourseInfo, $addNewGrade;

        // Find the student
        $studentIndex = $findStudentInfo->findStudentIndex($studentId);

        // Get student data
        $student = $findStudentInfo->getStudent($studentIndex);

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
        $courseExists = $findCourseInfo->doesCourseExist($courseCode);

        if (!$courseExists) {
            echo "Error: Course not found. <br>";
            return false;
        }

        // Check if student already has a grade for this course
        $isStudentEnrolled = $findStudentInfo->isStudentEnrolled($studentIndex, $courseCode, $score);

        // Add new grade
        $addNewGrade->addNewGrade($studentIndex, $courseCode, $score);

        echo "Grade added for student {$student['name']} in course {$courseCode}. <br>";
        $totalGradesAssigned++;
        return true;
    }
}