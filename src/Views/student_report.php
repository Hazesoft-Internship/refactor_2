<?php
foreach ($students as $student) {
    echo "<br>====== Student Report ======<br>";
    echo "ID: " . $student->getId() . "<br>";
    echo "Name: " . $student->getName() . "<br>";
    echo "Type: " . strtolower((new ReflectionClass($student))->getShortName()) . "<br>"; // Add this line to print type
    echo "GPA: " . $student->calculateGPA() . "<br>";
    echo "Courses:<br>";

    foreach ($student->getCourses() as $course => $details) {
        echo "- $course: Score = {$details['score']}, Grade = {$details['grade']}<br>";
    }
    echo "==========================\n";
}
