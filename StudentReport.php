<?php
require_once 'Repository/StudentRepository.php';

$studentRepo = new StudentRepository();
$courseRepo = new CourseRepository();
seedData($studentRepo, $courseRepo);

foreach ($studentRepo->students as $student) {
    echo "<br>====== Student Report ======<br>";
    echo "ID: {$student->id}<br>";
    echo "Name: {$student->name}<br>";
    echo "Type: {$student->type}<br>";
    echo "GPA: {$student->gpa}<br>";
    echo "Courses:<br>";
    if (empty($student->courses)) {
        echo "No courses registered.<br>";
    } else {
        foreach ($student->courses as $entry) {
            echo "- {$entry['course']->code}: Score = {$entry['score']}, Grade = {$entry['grade']}<br>";
        }
    }
    echo "==========================<br>";
}

echo "<a href='index.php'>Back to Dashboard</a><br>";
echo "<a href='SystemStatistics.php'>View System Statistics</a>";
