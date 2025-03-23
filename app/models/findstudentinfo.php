<?php

namespace App\Models;

require_once(__DIR__ . '/../../config/studentsdb.php');

class FindStudentInfo
{

    // return studentIndex i.e., position of student in the database
    public function findStudentIndex($studentId) : int
    {
        global $students;
        $studentIndex = -1;
        foreach ($students as $index => $student) {
            if ($student['id'] == $studentId) {
                $studentIndex = $index;
                break;
            }
        }
        return $studentIndex;
    }


    public function getStudent($studentIndex): array
    {
        global $students;
        return $students[$studentIndex];
    }

    // Check if student already has a grade for this course
    public function isStudentEnrolled($studentIndex)
    {
        global $students;
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
    }

}