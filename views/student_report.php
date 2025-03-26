<?php
echo "<br>====== Student Report ======<br>";
echo "ID: {$student->id}<br>";
echo "Name: {$student->name}<br>";
echo "Type: {$student->type}<br>";
echo "GPA: {$gpa}<br>";
echo "Courses:<br>";

if (empty($student->courses)) {
    echo "No courses registered.<br>";
} else {
    foreach ($student->courses as $course) {
        echo "- {$course['code']}: Score = {$course['score']}, Grade = {$course['letterGrade']}<br>";
    }
}

echo "==========================<br>";
