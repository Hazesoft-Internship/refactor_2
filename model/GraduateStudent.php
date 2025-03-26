<?php

namespace Model;

use Model\Student;

class GraduateStudent extends Student
{
    public function calculateLetterGrade($score): string
    {
        if ($score >= 90) {
            return 'A';
        }
        if ($score >= 80) {
            return 'B';
        }
        if ($score >= 70) {
            return 'C';
        }
        return 'F';
    }

    public function getType(): string
    {
        return 'Graduate';
    }
}
?>