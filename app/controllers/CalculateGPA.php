<?php

namespace App\Controllers;

use App\Models\FindStudentInfo;

require_once(__DIR__ . '/../models/FindStudentInfo.php');

$findStudentInfo = new FindStudentInfo();

class CalculateGPA
{
    public function calculateGPA($studentId): float
    {
        global $courses, $totalStudentsProcessed;
        global $findStudentInfo;

        // Find the student
        $studentIndex = $findStudentInfo->findStudentIndex($studentId);

        if ($studentIndex == -1) {
            echo "Error: Student not found.<br>";
            return -1;
        }

        $student = $findStudentInfo->getStudent($studentIndex);

        if (empty($student['courses'])) {
            echo "Student has no courses.<br>";
            return 0;
        }

        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($student['courses'] as $studentCourse) {
            // Find course credits
            $courseCredit = 0;
            foreach ($courses as $course) {
                if ($course['code'] == $studentCourse['code']) {
                    $courseCredit = $course['credits'];
                    break;
                }
            }

            // Convert letter grade to points
            $points = 0;
            switch ($studentCourse['letterGrade']) {
                case 'A':
                    $points = 4.0;
                    break;

                case 'B':
                    $points = 3.0;
                    break;

                case 'C':
                    $points = 2.0;
                    break;

                case 'D':
                    $points = 1.0;
                    break;

                case 'F':
                    $points = 0.0;
                    break;
            }

            $totalPoints += $points * $courseCredit;
            $totalCredits += $courseCredit;
        }

        $gpa = $totalCredits > 0 ? $totalPoints / $totalCredits : 0;
        $totalStudentsProcessed++;

        return round($gpa, 2);
    }
}