<?php

namespace App\Views;

require_once (__DIR__ . '/../controllers/calculategpa.php');
require_once(__DIR__ . '/../models/findstudentinfo.php');

use App\Controllers\CalculateGPA;
use App\Models\FindStudentInfo;


// objects declaration
$calculateGPA = new CalculateGPA();
$findStudentInfo = new FindStudentInfo();


class DisplayStudentReport {
    public function displayStudentReport($studentId)
    {
        global $calculateGPA, $findStudentInfo;

        // Find the student
        $studentIndex = $findStudentInfo->findStudentIndex($studentId);

        if ($studentIndex == -1) {
            echo "Error: Student not found.<br>";
            return;
        }

        $student = $findStudentInfo->getStudent($studentIndex);
        $gpa = $calculateGPA->calculateGPA($studentId);

        echo "<br>====== Student Report ====== <br>";
        echo "ID: {$student['id']} <br>";
        echo "Name: {$student['name']} <br>";
        echo "Type: {$student['type']} <br>";
        echo "GPA: {$gpa} <br>";
        echo "Courses: <br>";

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