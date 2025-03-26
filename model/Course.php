<?php

namespace Model;

class Course
{
    private $code;
    private $name;
    private $credits;

    public function __construct($code, $name, $credits)
    {
        $this->code    = $code;
        $this->name    = $name;
        $this->credits = $credits;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCredits(): int
    {
        return $this->credits;
    }
}
?>