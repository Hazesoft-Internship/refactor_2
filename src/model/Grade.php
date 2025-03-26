<?php

namespace src\model;

use \src\validate\Validator;

class Grade
{
    protected $studentId;
    protected $courseCode;
    protected $score;
    protected Validator $validate;
    public function __construct(string $courseCode, int $score, Validator $validate)
    {
        $this->validate = $validate;
        $this->validate->isCourseAvailable($courseCode);
        $this->validate->isScoreValid($score);
        $this->courseCode = $courseCode;
        $this->score = $score;
    } 
}
