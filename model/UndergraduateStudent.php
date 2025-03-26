<?php

namespace Model;

use Model\Student;

class UndergraduateStudent extends Student
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
        if ($score >= 60) {
            return 'D';
        }
        return 'F';
    }

    public function getType(): string
    {
        return 'Undergraduate';
    }
}
?>