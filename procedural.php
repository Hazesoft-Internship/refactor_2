<?php

header('Content-Type: text/html; charset=utf-8');

// Student Grade Management System

// Database of students (simulated with arrays)
$students = [
    ['id' => 1, 'name' => 'John Doe', 'type' => 'undergraduate', 'courses' => []],
    ['id' => 2, 'name' => 'Jane Smith', 'type' => 'graduate', 'courses' => []],
    ['id' => 3, 'name' => 'Mike Johnson', 'type' => 'undergraduate', 'courses' => []],
    ['id' => 4, 'name' => 'Sarah Williams', 'type' => 'phd', 'courses' => []]
];

// Database of courses (simulated with arrays)
$courses = [
    ['code' => 'CS101', 'name' => 'Introduction to Programming', 'credits' => 3],
    ['code' => 'CS201', 'name' => 'Data Structures', 'credits' => 4],
    ['code' => 'MATH101', 'name' => 'Calculus I', 'credits' => 3],
    ['code' => 'ENG101', 'name' => 'English Composition', 'credits' => 2]
];

// Global stats
$totalGradesAssigned = 0;
$totalStudentsProcessed = 0;

// Function to add a grade for a student in a course
function addGrade($studentId, $courseCode, $score)
{
    global $students, $totalGradesAssigned;

    // Find the student
    $studentIndex = -1;
    foreach ($students as $index => $student) {
        if ($student['id'] == $studentId) {
            $studentIndex = $index;
            break;
        }
    }

    if ($studentIndex == -1) {
        echo "Error: Student not found.<br>";
        return false;
    }

    // Validate score
    if ($score < 0 || $score > 100) {
        echo "Error: Score must be between 0 and 100.<br>";
        return false;
    }

    // Check if course exists
    $courseExists = false;
    global $courses;
    foreach ($courses as $course) {
        if ($course['code'] == $courseCode) {
            $courseExists = true;
            break;
        }
    }

    if (!$courseExists) {


        echo "Error: Course not found.<br>";
        return false;
    }

    // Check if student already has a grade for this course
    foreach ($students[$studentIndex]['courses'] as $index => $course) {
        if ($course['code'] == $courseCode) {
            // Update existing grade
            $students[$studentIndex]['courses'][$index]['score'] = $score;
            $students[$studentIndex]['courses'][$index]['letterGrade'] = calculateLetterGrade($score, $students[$studentIndex]['type']);
            echo "Grade updated for student {$students[$studentIndex]['name']} in course {$courseCode}.<br>";
            $totalGradesAssigned++;
            return true;
        }
    }

    // Add new grade
    $students[$studentIndex]['courses'][] = [
        'code' => $courseCode,
        'score' => $score,
        'letterGrade' => calculateLetterGrade($score, $students[$studentIndex]['type'])
    ];

    echo "Grade added for student {$students[$studentIndex]['name']} in course {$courseCode}.<br>";
    $totalGradesAssigned++;
    return true;
}

// Function to calculate letter grade based on score and student type
function calculateLetterGrade($score, $studentType)
{
    // Different grading scales based on student type
    if ($studentType == 'undergraduate') {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    } else if ($studentType == 'graduate') {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        return 'F';
    } else if ($studentType == 'phd') {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        return 'F';
    }

    // Default grading scale
    return 'N/A';
}

// Function to calculate GPA for a student
function calculateGPA($studentId)
{
    global $students, $courses, $totalStudentsProcessed;

    // Find the student
    $studentIndex = -1;
    foreach ($students as $index => $student) {
        if ($student['id'] == $studentId) {
            $studentIndex = $index;
            break;
        }
    }

    if ($studentIndex == -1) {
        echo "Error: Student not found.<br>";
        return -1;
    }

    $student = $students[$studentIndex];

    if (empty($student['courses'])) {
        echo "Student has no courses.<br>";
        return 0;
    }

    $totalPoints = 0;
    $totalCredits = 0;

    foreach ($student['courses'] as $studentCourse) {
        // Find course credits
        $courseCredit = 0;
        foreach ($courses as $course) {
            if ($course['code'] == $studentCourse['code']) {
                $courseCredit = $course['credits'];
                break;
            }
        }

        // Convert letter grade to points
        $points = 0;
        switch ($studentCourse['letterGrade']) {
            case 'A':
                $points = 4.0;
                break;

            case 'B':
                $points = 3.0;
                break;

            case 'C':
                $points = 2.0;
                break;

            case 'D':
                $points = 1.0;
                break;

            case 'F':
                $points = 0.0;
                break;
        }

        $totalPoints += $points * $courseCredit;
        $totalCredits += $courseCredit;
    }

    $gpa = $totalCredits > 0 ? $totalPoints / $totalCredits : 0;
    $totalStudentsProcessed++;

    return round($gpa, 2);
}

// Function to display student report
function displayStudentReport($studentId)
{
    global $students;

    // Find the student
    $studentIndex = -1;
    foreach ($students as $index => $student) {
        if ($student['id'] == $studentId) {
            $studentIndex = $index;
            break;
        }
    }

    if ($studentIndex == -1) {
        echo "Error: Student not found.<br>";
        return;
    }

    $student = $students[$studentIndex];
    $gpa = calculateGPA($studentId);

    echo "<br>====== Student Report ======<br>";
    echo "ID: {$student['id']}<br>";
    echo "Name: {$student['name']}<br>";
    echo "Type: {$student['type']}<br>";
    echo "GPA: {$gpa}<br>";
    echo "Courses:<br>";

    if (empty($student['courses'])) {
        echo "No courses registered.<br>";
    } else {
        foreach ($student['courses'] as $course) {
            echo "- {$course['code']}: Score = {$course['score']}, Grade = {$course['letterGrade']}<br>";
        }
    }

    echo "==========================<br>";
}

// Function to get statistics about the system
function getSystemStatistics()
{
    global $students, $totalGradesAssigned, $totalStudentsProcessed;

    $totalStudents = count($students);
    $studentsWithCourses = 0;
    $totalCourseEnrollments = 0;

    foreach ($students as $student) {
        if (!empty($student['courses'])) {
            $studentsWithCourses++;
            $totalCourseEnrollments += count($student['courses']);
        }
    }

    echo "<br>====== System Statistics ======<br>";
    echo "Total Students: {$totalStudents}<br>";
    echo "Students with Courses: {$studentsWithCourses}<br>";
    echo "Total Course Enrollments: {$totalCourseEnrollments}<br>";
    echo "Total Grades Assigned: {$totalGradesAssigned}<br>";
    echo "Total Students Processed: {$totalStudentsProcessed}<br>";
    echo "==============================<br>";
}

// Demo usage of the system
function runDemo()
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

// Run the demo
runDemo();
