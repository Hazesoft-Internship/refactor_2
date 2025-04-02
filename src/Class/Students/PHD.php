<?php

namespace Weave\Refactor2\Class\Students;

use Weave\Refactor2\Class\Student;

class PHD extends Student
{
    public function calculateGPA()
    {
        $totalCredits = 0;
        $totalPoints = 0;

        foreach ($this->courses as $entry) {
            $credits = $entry['course']->credits;
            $grade = $entry['grade'];
            $totalCredits += $credits;
            $totalPoints += $credits * match ($grade) {
                'A' => 4,
                'B' => 3,
                default => 0,
            };
        }

        $this->gpa = $totalCredits ? $totalPoints / $totalCredits : 0;
    }
}
