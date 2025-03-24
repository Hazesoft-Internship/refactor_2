<?php
class SystemStatistics {
	private $students;
	private $totalGradesAssigned;

	public function __construct($students, $totalGradesAssigned) {
		$this->students = $students;
		$this->totalGradesAssigned = $totalGradesAssigned;
	}

	public function displayStatistics() {
		echo "<br>====== System Statistics ======<br>";
		echo "Total Students: " . count($this->students) . "<br>";
		echo "Total Grades Assigned: {$this->totalGradesAssigned}<br>";
		echo "==============================<br>";
	}
}

// Example usage
$students = []; // Replace with actual students array
$totalGradesAssigned = 0; // Replace with actual total grades assigned
$stats = new SystemStatistics($students, $totalGradesAssigned);
$stats->displayStatistics();
