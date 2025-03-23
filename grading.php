
<?php
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

class Grade
{
    public static $totalGradesAssigned = 0;
    public static $totalStudentsProcessed = 0;

    public function findStudent($studentId): int
    {
        global $students;
        $studentIndex = -1;
        foreach ($students as $index => $student) {
            if ($student['id'] == $studentId) {
                return $index;
            }
        }
    }

    public function addGrade($studentId, $courseCode, $score): bool
    {

        global $students, $courses;
        $studentIndex = $this->findStudent($studentId);

        if($studentIndex == -1)
        {
            echo "Error: Student not found on database <br>";
            return false;
        }

        if(($score<0) || ($score>100))
        {
            echo "Error: Score of student must be inbetween 0 and 100";
            return false;
        }

        $courseExists = false;
        foreach($courses as $course)
        {
            if($course['code'] == $courseCode)
            {
                $courseExists = true;
            }
        }

        if(!$courseExists)
        {
            echo "Error: Course doesn't exists";
            return false;
        }

        foreach($students[$studentIndex]['courses'] as $index => $course) {
            if ($course['code'] == $courseCode) {
                // Update existing grade
                $students[$studentIndex]['courses'][$index]['score'] = $score;
                $students[$studentIndex]['courses'][$index]['letterGrade'] = $this->calculateLetterGrade($score, $students[$studentIndex]['type']);
                echo "Grade updated for student {$students[$studentIndex]['name']} in course {$courseCode}.<br>";
                self::$totalGradesAssigned++;
                return true;
            }
        }

        $students[$studentIndex]['courses'][] = [
            'code' => $courseCode,
            'score' => $score,
            'letterGrade' => $this->calculateLetterGrade($score, $students[$studentIndex]['type'])
        ];

        echo "Grade added for student {$students[$studentIndex]['name']} in course {$courseCode}.<br>";
        self::$totalGradesAssigned++;
        return true;
    }

    function calculateGPA($studentId) {
        global $students, $courses;
    
        // Find the student
        $studentIndex = $this->findStudent($studentId);
    
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
        self::$totalStudentsProcessed++;
    
        return round($gpa, 2);
    }

    public function calculateLetterGrade($score, $studentType)
    {
        // Different grading scales based on student type
        if ($studentType == 'undergraduate') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            if ($score >= 70) return 'C';
            if ($score >= 60) return 'D';
            return 'F';
    }   else if ($studentType == 'graduate') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            if ($score >= 70) return 'C';
            return 'F';
    }   else if ($studentType == 'phd') {
            if ($score >= 90) return 'A';
            if ($score >= 80) return 'B';
            return 'F';
    }

        // Default grading scale
        return 'N/A';
    }
}