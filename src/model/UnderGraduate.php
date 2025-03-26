<?php

namespace src\model;

use src\validate\Validator;
use src\model\Grade;
use src\model\Course;

class UnderGraduate extends Student
{

    public function __construct(int $id, string $name, Validator $validator, $type = "Undergraduate")
    {
        parent::__construct($id, $name, $type, $validator);
    }

    public function getName()
    {
        echo $this->name;
    }

    public function calculateLetterGrade($score):string
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    }
        
        
}
