<?php
class ReportView
{
    public static function display($student, $gpa)
    {
        $output = "<br>====== Student Report ======<br>";
        $output .= "ID: {$student->id}<br>";
        $output .= "Name: {$student->name}<br>";
        $output .= "Type: {$student->type}<br>";
        $output .= "GPA: " . number_format($gpa, 2) . "<br>";
        $output .= "Courses:<br>";

        if (empty($student->courses)) {
            $output .= "No courses registered.<br>";
        } else {
            foreach ($student->courses as $course) {
                $output .= "- {$course['code']}: ";
                $output .= "Score = {$course['score']}, ";
                $output .= "Grade = {$course['grade']}<br>";
            }
        }

        return $output . "==========================<br>";
    }
}