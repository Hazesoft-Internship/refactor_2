<?php

namespace Weave\Refactor2\Class\Students;

use Weave\Refactor2\Class\Student;

class Graduate extends Student
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
                'C' => 2,
                default => 0,
            };
        }

        $this->gpa = $totalCredits ? $totalPoints / $totalCredits : 0;
    }
}
