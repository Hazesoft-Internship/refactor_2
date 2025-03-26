<?php
interface GradingStrategy
{
    public function calculateGrade($score);
}

class UndergraduateGrading implements GradingStrategy
{
    public function calculateGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    }
}

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

class PhDGrading implements GradingStrategy
{
    public function calculateGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        return 'F';
    }
}