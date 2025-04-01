<?php

namespace Hazesoft\Refactor2\Models;

class PhD extends Student
{
    protected function calculateGrade(int $score): string
    {
        return match (true) {
            $score >= 95 => 'A',
            $score >= 85 => 'B',
            $score >= 75 => 'C',
            $score >= 65 => 'D',
            default => 'F',
        };
    }
}
