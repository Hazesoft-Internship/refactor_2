<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "./Db.php";

class Student
{
    public static function findStudent($studentId)
    {
        $students = Data::getStudents();

        foreach ($students as $index => $student) {
            if ($student['id'] == $studentId) {
                return $index;
            }
        }
        return false;
    }
}
