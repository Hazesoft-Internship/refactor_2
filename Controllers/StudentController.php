<?php

namespace Refactor2\Controllers;

require_once(__DIR__ . '/../Models/Student.php');

use Refactor2\Models\Student;

class StudentController extends Student
{
    public function addGrade(int $studentID, string $courseCode, int $score)
    {
        if ($score < 0 || $score > 100) {
            echo "Error: Score must be between 0 and 100.<br>";
            return false;
        }

        $studentIndex = array_search($studentID, array_column(self::$students, 'id'));

        self::$students[$studentIndex]['courses'][] = [
            'code' => $courseCode,
            'score' => $score,
            'letterGrade' => $this->calculateLetterGrade(self::$students[$studentIndex]['type'], $score)
        ];

        echo "Grade added for student " . self::$students[$studentIndex]['name'] . " in course {$courseCode}.<br>";
        self::$totalGradesAssigned++;
        return true;
    }

    public function displayStudentReport(int $studentID)
    {
        $studentIndex = array_search($studentID, array_column(self::$students, 'id'));
        $studentData = self::$students[$studentIndex];
        $gpa = $this->gpaCalculate($studentID);

        echo "<br>====== Student Report ======<br>";
        echo "ID: {$studentData['id']}<br>";
        echo "Name: {$studentData['name']}<br>";
        echo "Type: {$studentData['type']}<br>";
        echo "GPA: {$gpa}<br>";

        echo "Courses:<br>";

        foreach ($studentData['courses'] as $course) {
            echo "- {$course['code']}: Score = {$course['score']}, Grade = {$course['letterGrade']}<br>";
        }
        echo "==========================<br>";
    }
}
