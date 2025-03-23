<?php

namespace App\Views;

class RunDemo {
    public function runDemo()
    {
        // Add some grades
        addGrade(1, 'CS101', 85);
        addGrade(1, 'MATH101', 92);
        addGrade(2, 'CS201', 78);
        addGrade(3, 'ENG101', 65);
        addGrade(3, 'CS101', 72);
        addGrade(4, 'CS201', 95);

        // Display student reports
        displayStudentReport(1);
        displayStudentReport(2);
        displayStudentReport(3);
        displayStudentReport(4);

        // Show system statistics
        getSystemStatistics();
    }
}
