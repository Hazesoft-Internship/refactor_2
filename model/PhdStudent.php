<?php

namespace Model;

use Model\Student;

class PhdStudent extends Student
{
    public function calculateLetterGrade($score): string
    {
        if ($score >= 90) {
            return 'A';
        }
        if ($score >= 80) {
            return 'B';
        }
        return 'F';
    }

    public function getType(): string
    {
        return 'PHD';
    }
}
?>