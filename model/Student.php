<?php

namespace Model;

use Model\GradeRecord;
use Model\Course;

require_once 'GradeRecord.php';
require_once 'Course.php';

abstract class Student
{
    protected $id;
    protected $name;
    protected $grades = [];

    public function __construct($id, $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    abstract public function calculateLetterGrade($score): string;

    public function addOrUpdateGrade(Course $course, $score): void
    {
        if ($score < 0 || $score > 100) {
            throw new \InvalidArgumentException('Score must be between 0 and 100.');
        }

        $letterGrade = $this->calculateLetterGrade($score);

        // Check for an existing grade for this course.
        foreach ($this->grades as $gradeRecord) {
            if ($gradeRecord->getCourse()->getCode() === $course->getCode()) {
                $gradeRecord->setScore($score, $letterGrade);
                return;
            }
        }

        // Otherwise, add a new grade record.
        $this->grades[] = new GradeRecord($course, $score, $letterGrade);
    }

    public function calculateGPA(): float
    {
        if (empty($this->grades)) {
            return 0.0;
        }

        $totalPoints  = 0.0;
        $totalCredits = 0;

        foreach ($this->grades as $gradeRecord) {
            $courseCredits = $gradeRecord->getCourse()->getCredits();
            $points        = $this->letterGradeToPoints($gradeRecord->getLetterGrade());
            $totalPoints  += $points * $courseCredits;
            $totalCredits += $courseCredits;
        }

        return $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0.0;
    }

    protected function letterGradeToPoints($letterGrade): float
    {
        switch ($letterGrade) {
            case 'A':
                return 4.0;
            case 'B':
                return 3.0;
            case 'C':
                return 2.0;
            case 'D':
                return 1.0;
            case 'F':
                return 0.0;
            default:
                return 0.0;
        }
    }

    public function getGrades(): array
    {
        return $this->grades;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function getType(): string;
}
?>