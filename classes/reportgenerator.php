<?php
class ReportGenerator {
    public static function generateStudentReport(Student $student, $courses) {
        $report = $student->getReport();
        $gpa = $student->getGPA($courses);

        echo "<br>====== Student Report ======<br>";
        echo "ID: {$report['id']}<br>";
        echo "Name: {$report['name']}<br>";
        echo "Type: {$report['type']}<br>";
        echo "GPA: {$gpa}<br>";
        echo "Courses:<br>";

        if (empty($report['courses'])) {
            echo "No courses registered.<br>";
        } else {
            foreach ($report['courses'] as $course) {
                echo "- {$course['code']}: Score = {$course['score']}, Grade = {$course['letterGrade']}<br>";
            }
        }

        echo "==========================<br>";
    }
}