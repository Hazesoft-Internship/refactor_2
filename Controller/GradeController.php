<?php
class GradeController
{
    private $students = [];
    private $courses = [];
    private $stats = [
        'total_grades' => 0,
        'processed_students' => 0
    ];

    public function addStudent($student)
    {
        $this->students[] = $student;
    }

    public function addCourse($course)
    {
        $this->courses[] = $course;
    }

    public function addGrade($studentId, $courseCode, $score)
    {
        foreach ($this->students as &$student) {
            if ($student->id == $studentId) {
                foreach ($this->courses as $course) {
                    if ($course->code == $courseCode) {
                        $gradingStrategy = $this->getGradingStrategy($student->type);
                        $grade = $gradingStrategy->calculateGrade($score);

                        foreach ($student->courses as &$crs) {
                            if ($crs['code'] == $courseCode) {
                                $crs['score'] = $score;
                                $crs['grade'] = $grade;
                                $this->stats['total_grades']++;
                                return true;
                            }
                        }

                        $student->courses[] = [
                            'code' => $courseCode,
                            'score' => $score,
                            'grade' => $grade
                        ];
                        $this->stats['total_grades']++;
                        return true;
                    }
                }
                throw new Exception("Course not found: $courseCode");
            }
        }
        throw new Exception("Student not found: $studentId");
    }

    private function getGradingStrategy($type)
    {
        switch ($type) {
            case 'undergraduate':
                return new UndergraduateGrading();
            case 'graduate':
                return new GraduateGrading();
            case 'phd':
                return new PhDGrading();
            default:
                throw new Exception("Invalid student type: $type");
        }
    }

    public function calculateGpa($student)
    {
        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($student->courses as $courseData) {
            foreach ($this->courses as $course) {
                if ($course->code == $courseData['code']) {
                    $points = match ($courseData['grade']) {
                        'A' => 4.0,
                        'B' => 3.0,
                        'C' => 2.0,
                        'D' => 1.0,
                        default => 0.0
                    };
                    $totalPoints += $points * $course->credits;
                    $totalCredits += $course->credits;
                    break;
                }
            }
        }

        return $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0.0;
    }

    public function getStudentById($id)
    {
        foreach ($this->students as $student) {
            if ($student->id == $id) {
                return $student;
            }
        }
        throw new Exception("Student not found: $id");
    }

    public function getSystemStats()
    {
        $stats = [
            'total_students' => count($this->students),
            'students_with_courses' => 0,
            'total_grades' => $this->stats['total_grades'],
            'processed_students' => $this->stats['processed_students']
        ];

        foreach ($this->students as $student) {
            if (!empty($student->courses)) {
                $stats['students_with_courses']++;
            }
        }

        return $stats;
    }

    public function incrementProcessed()
    {
        $this->stats['processed_students']++;
    }
}