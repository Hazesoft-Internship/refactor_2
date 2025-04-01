<?php
class Student {
    private $id;
    private $name;
    private $type;
    private $courses = [];

    public function __construct($id, $name, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function addCourse($courseCode, $score, $letterGrade) {
        $this->courses[] = [
            'code' => $courseCode,
            'score' => $score,
            'letterGrade' => $letterGrade
        ];
    }

    public function getGPA($courses) {
        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($this->courses as $studentCourse) {
            
            $course = $courses[$studentCourse['code']]; 
            $courseCredit = $course->credits; 

            $points = match ($studentCourse['letterGrade']) {
                'A' => 4.0,
                'B' => 3.0,
                'C' => 2.0,
                'D' => 1.0,
                'F' => 0.0,
                default => 0.0,
            };

            $totalPoints += $points * $courseCredit;
            $totalCredits += $courseCredit;
        }

        return $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0;
    }

    public function getReport() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'courses' => $this->courses
        ];
    }
}