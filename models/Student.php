<?php

namespace Models;

abstract class Student
{
    public $id;
    public $name;
    public $courses = [];
    public $type;

    public function __construct($id, $name, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function addCourse($courseCode, $score): void
    {
        $letterGrade = $this->calculateLetterGrade($score);
        $this->courses[] = ['code' => $courseCode, 'score' => $score, 'letterGrade' => $letterGrade];
    }

    abstract protected function calculateLetterGrade($score): string;

    public function calculateGPA($courses): float|int
    {
        if (empty($this->courses)) return 0;
        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($this->courses as $studentCourse) {
            foreach ($courses as $course) {
                if ($course['code'] == $studentCourse['code']) {
                    $credit = $course['credits'];
                    $gradePoints = ['A' => 4.0, 'B' => 3.0, 'C' => 2.0, 'D' => 1.0, 'F' => 0.0];
                    $points = $gradePoints[$studentCourse['letterGrade']] ?? 0;
                    $totalPoints += $points * $credit;
                    $totalCredits += $credit;
                }
            }
        }

        return $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0;
    }
}

class UndergraduateStudent extends Student
{
    protected function calculateLetterGrade($score): string
    {
        return $score >= 90 ? 'A' : 
               ($score >= 80 ? 'B' : 
               ($score >= 70 ? 'C' : 
               ($score >= 60 ? 'D' : 'F')));
    }
}

class GraduateStudent extends Student
{
    protected function calculateLetterGrade($score): string
    {
        return $score >= 90 ? 'A' : 
               ($score >= 80 ? 'B' : 
               ($score >= 70 ? 'C' : 'F'));
    }
}

class PhDStudent extends Student
{
    protected function calculateLetterGrade($score): string
    {
        return $score >= 90 ? 'A' : 
               ($score >= 80 ? 'B' : 'F');
    }
}