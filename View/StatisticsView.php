<?php
class StatisticsView
{
    public static function display($stats)
    {
        $output = "<br>====== System Statistics ======<br>";
        $output .= "Total Students: {$stats['total_students']}<br>";
        $output .= "Students with Courses: {$stats['students_with_courses']}<br>";
        $output .= "Total Grades Assigned: {$stats['total_grades']}<br>";
        $output .= "Processed Students: {$stats['processed_students']}<br>";
        return $output . "==============================<br>";
    }
}