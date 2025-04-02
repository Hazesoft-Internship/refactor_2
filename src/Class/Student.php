<?php

namespace Weave\Refactor2\Class;

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

    public function addGrade($course, $grade)
    {
        $score = match ($grade) {
            'A' => 95,
            'B' => 85,
            'C' => 75,
            'D' => 65,
            default => 55,
        };
        $this->addCourse($course, $score, $grade);
    }

    abstract public function calculateGPA();
}
