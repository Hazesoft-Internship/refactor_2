<?php

namespace Model;

use Model\Course;

class GradeRecord
{
    private Course $course;
    private $score;
    private $letterGrade;

    public function __construct(Course $course, $score, $letterGrade)
    {
        $this->course = $course;
        $this->score = $score;
        $this->letterGrade = $letterGrade;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getLetterGrade(): string
    {
        return $this->letterGrade;
    }

    public function setScore($score, $letterGrade): void
    {
        $this->score = $score;
        $this->letterGrade = $letterGrade;
    }
}
?>