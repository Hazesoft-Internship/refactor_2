<?php

namespace Refactor2\Models;

require_once(__DIR__ . '/../ArrayDB.php');

use Refactor2\ArrayDB;

abstract class Student extends ArrayDB
{

    protected function calculateLetterGrade(string $studentType, int $score): string
    {
        // Different grading scales based on student type
        if ($studentType == 'undergraduate') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            if ($score >= 70) return 'C';
            if ($score >= 60) return 'D';
            return 'F';
        } else if ($studentType == 'graduate') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            if ($score >= 70) return 'C';
            return 'F';
        } else if ($studentType == 'phd') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            return 'F';
        }

        // Default grading scale
        return 'N/A';
    }

    protected function gpaCalculate(int $studentID): float
    {
        // Find the student
        $studentIndex = array_search($studentID, array_column(self::$students, 'id'));

        $student = self::$students[$studentIndex];

        if (empty($student['courses'])) {
            echo "Student has no courses.<br>";
            return 0;
        }

        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($student['courses'] as $studentCourse) {
            // Find course credits
            $courseCredit = 0;
            foreach (self::$courses as $course) {
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
        self::$totalStudentsProcessed++;

        return round($gpa, 2);
    }

    abstract public function addGrade(int $studentID, string $courseCode, int $score);
    abstract public function displayStudentReport(int $studentID);
}
