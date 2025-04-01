<?php

class Grade {
    private $id;
    private $studentId; 
    private $courseCode; 
    private $score; 
    private $letterGrade; 

    public function __construct($studentId, $courseCode, $score, $letterGrade) {
        $this->studentId = $studentId;
        $this->courseCode = $courseCode;
        $this->score = $score;
        $this->letterGrade = $letterGrade;
    }

    
    public function getStudentId() {
        return $this->studentId;
    }

    public function getCourseCode() {
        return $this->courseCode;
    }

    public function getScore() {
        return $this->score;
    }

    public function getLetterGrade() {
        return $this->letterGrade;
    }

  
    public function setScore($score) {
        $this->score = $score;
    }

    public function setLetterGrade($letterGrade) {
        $this->letterGrade = $letterGrade;
    }

   
    public static function calculateLetterGrade($score, $studentType) {
        if ($studentType === 'undergraduate') {
            return match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                $score >= 70 => 'C',
                $score >= 60 => 'D',
                default => 'F',
            };
        } elseif ($studentType === 'graduate') {
            return match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                $score >= 70 => 'C',
                default => 'F',
            };
        } elseif ($studentType === 'phd') {
            return match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                default => 'F',
            };
        }

        return 'N/A';
    }
}