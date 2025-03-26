<?php
require_once 'config.php';

// Initializing system
$controller = new GradeController();

// Adding students
$controller->addStudent(new Student(1, 'John Doe', 'undergraduate'));
$controller->addStudent(new Student(2, 'Jane Smith', 'graduate'));
$controller->addStudent(new Student(3, 'Mike Johnson', 'undergraduate'));
$controller->addStudent(new Student(4, 'Sarah Williams', 'phd'));

// Adding courses
$controller->addCourse(new Course('CS101', 'Introduction to Programming', 3));
$controller->addCourse(new Course('CS201', 'Data Structures', 4));
$controller->addCourse(new Course('MATH101', 'Calculus I', 3));
$controller->addCourse(new Course('ENG101', 'English Composition', 2));

// Operating Demo operations
try {
    // Add grades
    $controller->addGrade(1, 'CS101', 85);
    $controller->addGrade(1, 'MATH101', 92);
    $controller->addGrade(2, 'CS201', 78);
    $controller->addGrade(3, 'ENG101', 65);
    $controller->addGrade(3, 'CS101', 72);
    $controller->addGrade(4, 'CS201', 95);

    // Displaying reports
    $studentsToProcess = [1, 2, 3, 4];
    foreach ($studentsToProcess as $studentId) {
        $student = $controller->getStudentById($studentId);
        $gpa = $controller->calculateGpa($student);
        $controller->incrementProcessed();
        echo ReportView::display($student, $gpa);
    }

    // Showing statistics
    echo StatisticsView::display($controller->getSystemStats());

} catch (Exception $e) {
    echo "<div style='color: red'>Error: " . $e->getMessage() . "</div>";
}