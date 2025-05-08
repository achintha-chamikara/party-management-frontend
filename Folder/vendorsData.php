<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "party_planning_test"; // Make sure this matches the DB name you used

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all data from the theme table
$sql = "SELECT * FROM vendor";
$result = $conn->query($sql);

$themes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $themes[] = $row;
    }
}

// Return JSON
header('Content-Type: application/json');
echo json_encode($themes);

$conn->close();
?>
