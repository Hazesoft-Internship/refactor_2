<?php

namespace Repository;

use Model\Course;

require_once '../model/Course.php';

class CourseRepository
{
    private $courses = [];

    public function addCourse(Course $course): void
    {
        $this->courses[$course->getCode()] = $course;
    }

    public function getCourseByCode(string $code): Course
    {
        return $this->courses[$code];
    }

    public function getAllCourses(): array
    {
        return $this->courses;
    }
}
?>