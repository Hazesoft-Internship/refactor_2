<?php

namespace Hazesoft\Refactor2\Models;

class Undergraduate extends Student
{
    protected function calculateGrade(int $score): string
    {
        return match (true) {
            $score >= 85 => 'A',
            $score >= 75 => 'B',
            $score >= 65 => 'C',
            $score >= 55 => 'D',
            default => 'F',
        };
    }
}
