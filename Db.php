<?php

class Data{
private static $students = [
    ['id' => 1, 'name' => 'John Doe', 'type' => 'undergraduate', 'courses' => []],
    ['id' => 2, 'name' => 'Jane Smith', 'type' => 'graduate', 'courses' => []],
    ['id' => 3, 'name' => 'Mike Johnson', 'type' => 'undergraduate', 'courses' => []],
    ['id' => 4, 'name' => 'Sarah Williams', 'type' => 'phd', 'courses' => []]
];

private static $courses = [
    ['code' => 'CS101', 'name' => 'Introduction to Programming', 'credits' => 3],
    ['code' => 'CS201', 'name' => 'Data Structures', 'credits' => 4],
    ['code' => 'MATH101', 'name' => 'Calculus I', 'credits' => 3],
    ['code' => 'ENG101', 'name' => 'English Composition', 'credits' => 2]
];

public static function getStudents(){
    return self::$students;
}

public static function getCourses(){
    return self::$courses;
}
}
?>