<?php

namespace Class;

abstract class Course
{
    public $code;
    public $name;
    public $credits;

    public function __construct($code, $name, $credits)
    {
        $this->code = $code;
        $this->name = $name;
        $this->credits = $credits;
    }
}
