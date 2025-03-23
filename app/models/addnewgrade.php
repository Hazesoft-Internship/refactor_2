<?php

namespace App\Models;

require_once(__DIR__ . '/../../config/studentsdb.php');
require_once (__DIR__ . '/../controllers/calculatelettergrade.php');

use App\Controllers\CalculateLetterGrade;

$calculateLetterGrade = new CalculateLetterGrade();

class AddNewGrade {
    public function addNewGrade($studentIndex, $courseCode, $score): void
    {
        global $students;
        global $calculateLetterGrade;
        // Add new grade
        $students[$studentIndex]['courses'][] = [
            'code' => $courseCode,
            'score' => $score,
            'letterGrade' => $calculateLetterGrade->calculateLetterGrade($score, $students[$studentIndex]['type'])
        ];
    }
}