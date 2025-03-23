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

}