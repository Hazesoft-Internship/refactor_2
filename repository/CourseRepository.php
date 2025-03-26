<?php

namespace Repository;

use Model\Course;

require_once '../model/Course.php';

class CourseRepository
{
    private array $courses = [];

    public function addCourse(Course $course): void
    {
        $this->courses[$course->getCode()] = $course;
    }

    public function getCourseByCode($code): ?Course
    {
        return $this->courses[$code] ?? null;
    }

    public function getAllCourses(): array
    {
        return $this->courses;
    }
}
?>