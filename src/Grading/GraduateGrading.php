<?php

namespace suyas\refactor_2\Grading;

use suyas\refactor_2\Grading\GradingStrategy;

class GraduateGrading implements GradingStrategy
{
    public function calculateGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        return 'F';
    }
}
?>