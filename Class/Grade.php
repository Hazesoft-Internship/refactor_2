<?php
class Grade
{
    public static function getLetterGrade($score, $studentType)
    {
        return match ($studentType) {
            'Undergraduate' => match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                $score >= 70 => 'C',
                $score >= 60 => 'D',
                default => 'F',
            },
            'Graduate' => match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                $score >= 70 => 'C',
                default => 'F',
            },
            'PHD' => match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                default => 'F',
            },
        };
    }
}
