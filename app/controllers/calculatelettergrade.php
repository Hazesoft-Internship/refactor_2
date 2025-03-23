<?php

namespace App\Controllers;

class CalculateLetterGrade {
    public function calculateLetterGrade($score, $studentType)
    {
        // Different grading scales based on student type
        if ($studentType == 'undergraduate') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            if ($score >= 70) return 'C';
            if ($score >= 60) return 'D';
            return 'F';
        } else if ($studentType == 'graduate') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            if ($score >= 70) return 'C';
            return 'F';
        } else if ($studentType == 'phd') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            return 'F';
        }

        // Default grading scale
        return 'N/A';
    }
}