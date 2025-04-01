<?php
class Statistics {
    public static function getSystemStatistics($students) {
        $totalStudents = count($students);
        $studentsWithCourses = 0;
        $totalCourseEnrollments = 0;

        foreach ($students as $student) {
            $report = $student->getReport();
            if (!empty($report['courses'])) {
                $studentsWithCourses++;
                $totalCourseEnrollments += count($report['courses']);
            }
        }

        echo "<br>====== System Statistics ======<br>";
        echo "Total Students: {$totalStudents}<br>";
        echo "Students with Courses: {$studentsWithCourses}<br>";
        echo "Total Course Enrollments: {$totalCourseEnrollments}<br>";
        echo "==============================<br>";
    }
}