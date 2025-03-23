<?php

namespace App\Models;

require_once(__DIR__ . '/../../config/coursesdb.php');

class FindCourseInfo
{
    public function doesCourseExist($courseCode): bool
    {
        global $courses;
        $courseExists = false;
        foreach ($courses as $course) {
            if ($course['code'] == $courseCode) {
                $courseExists = true;
                break;
            }
        }
        return $courseExists;
    }
}