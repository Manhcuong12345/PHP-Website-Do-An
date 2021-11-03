
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "quanly_ban_sua";

$conn = new mysqli($hostname, $username, $password, $dbname);

	if ($conn->connect_error) {
	  die('Could not connect to the database!' . $conn->connect_error);
	}
?>

