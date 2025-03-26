<?php

namespace src\model;

use src\validate\Validator;
use src\model\Grade;
use src\model\Course;

abstract class Student
{
    protected static array $students = [
        ['id' => 1, 'name' => 'John Doe', 'type' => 'undergraduate', 'courses' => []],
        ['id' => 2, 'name' => 'Jane Smith', 'type' => 'graduate', 'courses' => []],
        ['id' => 3, 'name' => 'Mike Johnson', 'type' => 'undergraduate', 'courses' => []],
        ['id' => 4, 'name' => 'Sarah Williams', 'type' => 'phd', 'courses' => []]
    ];
    public $name;
    public $type;
    public $id;

    public function __construct(int $id, string $name, string $type, protected Validator $validator)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public static function getAllStudents()
    {
        return self::$students;
    }

    public function calculateGPA($studentId)
    {
        if ($this->validator->studentExist($studentId)) {

            $student = self::$students[$studentId - 1];

            if (empty($student['courses'])) {
                echo "Student has no courses.<br>";
                return 0;
            }

            $totalPoints = 0;
            $totalCredits = 0;

            foreach ($student['courses'] as $studentCourse) {

                $courseCredit = 0;
                foreach (Course::getCourses() as $course) {
                    if ($course['code'] == $studentCourse['code']) {
                        $courseCredit = $course['credits'];
                        break;
                    }
                }
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

            return round($gpa, 2);
        }
    }

    

    public function addGrade(string $courseCode,int $score)
    {
        if ($this->validator->isScoreValid($score) && $this->validator->isCourseAvailable($courseCode)) {

            $courseFound = false;
            foreach (self::$students as $student) {
                if ($student["id"] == $this->id) {
                    foreach ($student["courses"] as $course)
                        if ($course["code"] == $courseCode) {
                            $course["score"] = $score;
                            $courseFound = true;
                            break;
                        }
                }
            }

            if (!$courseFound) {
                $validate = new Validator();
                $grade = new Grade($courseCode, $score, $validate);

                self::$students[$this->id - 1]["courses"][] =
                    [
                        'code' => $courseCode,
                        'score' => $score,
                        "letterGrade" => $this->calculateLetterGrade($score)
                    ];
            }
        }
    }

    abstract protected function calculateLetterGrade(int $score);
}
