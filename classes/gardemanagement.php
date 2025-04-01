<?php
class GradeManager {
    public static function calculateLetterGrade($score, $studentType) {
        if ($studentType === 'undergraduate') {
            return match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                $score >= 70 => 'C',
                $score >= 60 => 'D',
                default => 'F',
            };
        } elseif ($studentType === 'graduate') {
            return match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                $score >= 70 => 'C',
                default => 'F',
            };
        } elseif ($studentType === 'phd') {
            return match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                default => 'F',
            };
        } 

        return 'N/A';
    }
}