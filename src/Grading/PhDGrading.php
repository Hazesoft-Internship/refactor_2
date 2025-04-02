<?php

namespace suyas\refactor_2\Grading;

use suyas\refactor_2\Grading\GradingStrategy;

class PhDGrading implements GradingStrategy
{
    public function calculateGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        return 'F';
    }
}
?>