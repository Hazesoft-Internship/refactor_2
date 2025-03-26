<?php
include_once("./config.php");

use src\model\Course;
use src\model\Student;
use src\model\UnderGraduate;
use src\model\Graduate;
use src\controller\DisplayStudentReport;
use src\model\Phd;
use src\model\Grade;
use src\validate\Validator;

$validate = new Validator();

try {
    $underGraduate = new UnderGraduate("1", "smithUnderGraduate", $validate);
    $underGraduate->addGrade("CS101", 71);
    $underGraduate->addGrade("CS201", 50);
    DisplayStudentReport::displayStudentReport($underGraduate);

} catch (Exception $exception) {
    echo $exception->getMessage() . " in underGraduate";
}

try {
    $Graduate = new Graduate("2", "smithGraduate", $validate);
    $Graduate->addGrade("CS101", 71);
    $Graduate->addGrade("CS201", 50);
    DisplayStudentReport::displayStudentReport($Graduate);

} catch (Exception $exception) {
    echo $exception->getMessage() . " in Graduate";
}

try {
    $phd = new Phd("4", "smithPhd", $validate);
    $phd->addGrade("CS101", 71);
    $phd->addGrade("CS201", 90);
    DisplayStudentReport::displayStudentReport($phd);
} catch (Exception $exception) {
    echo $exception->getMessage() . " in phd";
}
