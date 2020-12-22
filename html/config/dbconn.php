<?
$servername = 'mysql.tsstation.com';
$username = 'mkn';
$password = 'tsts5424!!';
$db = 'mkn';
$port = '3306';
$charset = 'utf8';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	// echo "Connected successfully";
}

mysqli_set_charset($conn, 'utf8');
?>