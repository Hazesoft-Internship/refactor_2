<?php

namespace Class;

abstract class Student
{
    public $id;
    public $name;
    public $type;
    public $courses = [];
    public $gpa;

    public function __construct($id, $name, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function addCourse($course, $score, $grade)
    {
        $this->courses[] = ['course' => $course, 'score' => $score, 'grade' => $grade];
    }

    public function calculateGPA()
    {
        $totalPoints = 0;
        $totalCredits = 0;
        foreach ($this->courses as $entry) {
            $points = match ($entry['grade']) {
                'A' => 4.0,
                'B' => 3.0,
                'C' => 2.0,
                'D' => 1.0,
                'F' => 0.0
            };
            $totalPoints += $points * $entry['course']->credits;
            $totalCredits += $entry['course']->credits;
        }
        $this->gpa = $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0; // Avoid division by zero
    }
}
