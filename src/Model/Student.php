<?php

namespace suyas\refactor_2\Model;

class Student
{
    public $id;
    public $name;
    public $type;
    public $courses = [];

    public function __construct($id, $name, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }
}