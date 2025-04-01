<?php

namespace Hazesoft\Refactor2\Models;

abstract class Student
{
    protected int $id;
    protected string $name;
    protected array $courses = [];

    protected static int $totalStudents = 0;
    protected static int $totalGradesAssigned = 0;
    protected static int $totalEnrollments = 0;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        static::$totalStudents++;
    }

    abstract protected function calculateGrade(int $score): string;

    public function addCourse(string $courseCode, int $score)
    {
        $grade = $this->calculateGrade($score);
        $this->courses[$courseCode] = ['score' => $score, 'grade' => $grade];
        static::$totalGradesAssigned++;
        static::$totalEnrollments++;

        echo "Grade added for student {$this->name} in course {$courseCode}.<br>";
    }

    public function calculateGPA(): float
    {
        if (empty($this->courses)) return 0;

        $totalScore = array_sum(array_column($this->courses, 'score'));
        return round($totalScore / count($this->courses) / 25, 2);
    }

    public static function getStatistics(): array
    {
        return [
            'totalStudents' => static::$totalStudents,
            'studentsWithCourses' => static::$totalStudents,
            'totalEnrollments' => static::$totalEnrollments,
            'totalGradesAssigned' => static::$totalGradesAssigned,
            'totalStudentsProcessed' => static::$totalStudents,
        ];
    }

    public function getCourses(): array
    {
        return $this->courses;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
