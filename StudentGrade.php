<?php
require_once "./Db.php";
require_once "./Student.php";

class StudentGrade
{

    public $students;
    public $courses;
    public static $totalGradesAssigned = 0;
    public static $totalStudentsProcessed = 0;

    public function __construct()
    {
        $this->students = Data::getStudents();
        $this->courses = Data::getCourses();
    }

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

    function addGrade($studentId, $courseCode, $score)
    {

        $studentIndex = Student::findStudent($studentId);


        if ($studentIndex === false) {
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
        foreach ($this->courses as $course) {
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
        foreach ($this->students[$studentIndex]['courses'] as $index => $course) {
            if ($course['code'] == $courseCode) {
                // Update existing grade
                $this->students[$studentIndex]['courses'][$index]['score'] = $score;
                $this->students[$studentIndex]['courses'][$index]['letterGrade'] = $this->calculateLetterGrade($score, $this->students[$studentIndex]['type']);
                echo "Grade updated for student {$this->students[$studentIndex]['name']} in course {$courseCode}.<br>";
                $this->totalGradesAssigned++;
                return true;
            }
        }

        // Add new grade
        $this->students[$studentIndex]['courses'][] = [
            'code' => $courseCode,
            'score' => $score,
            'letterGrade' => $this->calculateLetterGrade($score, $this->students[$studentIndex]['type'])
        ];

        echo "Grade added for student {$this->students[$studentIndex]['name']} in course {$courseCode}.<br>";
        self::$totalGradesAssigned++;
        return true;
    }

    function calculateGPA($studentId)
    {

        // Find the student
        $studentIndex = Student::findStudent($studentId);


        if ($studentIndex === false) {
            echo "Error: Student not found.<br>";
            return false;
        }

        $student = $this->students[$studentIndex];

        if (empty($student['courses'])) {
            echo "Student has no courses.<br>";
            return 0;
        }

        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($student['courses'] as $studentCourse) {
            // Find course credits
            $courseCredit = 0;
            foreach ($this->courses as $course) {
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
}
