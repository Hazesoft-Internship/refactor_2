<?php
namespace Models;

class Student {
    public $id;
    public $name;
    public $type;
    public $courses = [];

    public function __construct($id, $name, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function addCourse($courseCode, $score) {
        $letterGrade = $this->calculateLetterGrade($score);
        $this->courses[] = ['code' => $courseCode, 'score' => $score, 'letterGrade' => $letterGrade];
    }

    private function calculateLetterGrade($score) {
        if ($this->type == 'undergraduate') {
            return $score >= 90 ? 'A' : ($score >= 80 ? 'B' : ($score >= 70 ? 'C' : ($score >= 60 ? 'D' : 'F')));
        } elseif ($this->type == 'graduate') {
            return $score >= 90 ? 'A' : ($score >= 80 ? 'B' : ($score >= 70 ? 'C' : 'F'));
        } elseif ($this->type == 'phd') {
            return $score >= 90 ? 'A' : ($score >= 80 ? 'B' : 'F');
        }
        return 'N/A';
    }

    public function calculateGPA($courses) {
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
