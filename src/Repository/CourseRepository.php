<?php

namespace Weave\Refactor2\Repository;

use Weave\Refactor2\Class\Course;

class CourseRepository
{
    public static $courses = [];

    public static function initialize()
    {
        self::$courses = [
            new Course('CS101', 'Introduction to Programming', 3),
            new Course('CS201', 'Data Structures', 4),
            new Course('MATH101', 'Calculus I', 3),
            new Course('ENG101', 'English Composition', 2)
        ];
    }
}
