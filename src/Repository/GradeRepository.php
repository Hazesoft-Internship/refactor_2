<?php

namespace Weave\Refactor2\Repository;

class GradeRepository
{
    public static $grades = [];

    public static function initialize()
    {
        self::$grades = [
            [1, 'CS101', 85],
            [1, 'MATH101', 92],
            [2, 'CS201', 78],
            [3, 'ENG101', 65],
            [3, 'CS101', 72],
            [4, 'CS201', 95]
        ];
    }
}
