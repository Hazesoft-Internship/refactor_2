<?php

namespace Hazesoft\Refactor2\Controllers;

use Hazesoft\Refactor2\Models\Undergraduate;
use Hazesoft\Refactor2\Models\Graduate;
use Hazesoft\Refactor2\Models\PhD;

class StudentController
{
    private array $students = [];

    public function __construct()
    {
        $this->students[] = $student1 = new Undergraduate(1, 'John Doe');
        $this->students[] = $student2 = new Graduate(2, 'Jane Smith');
        $this->students[] = $student3 = new Undergraduate(3, 'Mike Johnson');
        $this->students[] = $student4 = new PhD(4, 'Sarah Williams');

        $student1->addCourse('CS101', 85);
        $student1->addCourse('MATH101', 92);
        $student2->addCourse('CS201', 78);
        $student3->addCourse('ENG101', 65);
        $student3->addCourse('CS101', 72);
        $student4->addCourse('CS201', 95);
    }
    public function showReports()
    {
        $students = $this->students;
        include __DIR__ . '/../Views/student_report.php';
    }


    public function showStatistics()
    {
        include __DIR__ . '/../Views/system_statistics.php';
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}
