<?php
class SystemStatistics
{
	private $students;
	private $totalGradesAssigned;

	public function __construct($students, $totalGradesAssigned)
	{
		$this->students = $students;
		$this->totalGradesAssigned = $totalGradesAssigned;
	}

	public function displayStatistics()
	{
		echo "<br>====== System Statistics ======<br>";
		echo "Total Students: " . count(value: $this->students) . "<br>";
		echo "Total Grades Assigned: {$this->totalGradesAssigned}<br>";
		echo "==============================<br>";
	}
}


$students = ['John Doe', 'Jane Smith', 'Mike Johnson', 'Sarah Williams']; 
$totalGradesAssigned = 6; 
$stats = new SystemStatistics(students: $students, totalGradesAssigned: $totalGradesAssigned);
$stats->displayStatistics();
