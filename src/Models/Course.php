<?php

namespace Hazesoft\Refactor2\Models;

class Course
{
    private $code;
    private $name;
    private $credits;

    public function __construct($code, $name, $credits)
    {
        $this->code = $code;
        $this->name = $name;
        $this->credits = $credits;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCredits()
    {
        return $this->credits;
    }
}
