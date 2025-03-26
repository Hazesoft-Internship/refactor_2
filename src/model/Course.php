<?php

namespace src\model;

class Course
{
    protected $code;
    protected $name;
    protected $credit;
    protected static array $courses = [
        ['code' => 'CS101', 'name' => 'Introduction to Programming', 'credits' => 3],
        ['code' => 'CS201', 'name' => 'Data Structures', 'credits' => 4],
        ['code' => 'MATH101', 'name' => 'Calculus I', 'credits' => 3],
        ['code' => 'ENG101', 'name' => 'English Composition', 'credits' => 2]
    ];

    public function __construct(string $code, string $name, int $credit)
    {
        $this->code = $code;
        $this->name = $name;
        $this->credit = $credit;
    }

    public static function getCourses():array
    {
        return self::$courses;
    }
}
