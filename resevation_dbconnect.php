<?php
$host = "localhost";
$user = "root";
$password = ""; 
$database = "party_planning_test";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed: " . $conn->connect_error;
    exit();
}

// Get POST data
$customerId = $_POST['customerId'];
$partyType = $_POST['partyType'];
$date = $_POST['date'];
$fromTime = $_POST['fromTime'];
$toTime = $_POST['toTime'];
$musicPartnerId = $_POST['musicPartnerId'];
$photoVideoId = $_POST['photoVideoId'];
$albumStatus = $_POST['albumStatus'];
$photoDuration = $_POST['photoDuration'];
$foodPartnerId = $_POST['foodPartnerId'];
$foodCategory = $_POST['foodCategory'];
$guests = $_POST['guests'];
$description = $_POST['description'];
$theme = $_POST['theme'];
$venueid = $_POST['venueid'];

// SQL insert (modify the table and field names based on your actual DB)
$sql = "INSERT INTO reservation (
  cus_id, party_type, date, time_from, time_to, music_partner_id, photo_video_id,
  album_status, photo_duration, food_partner_id, food_category,
  no_of_guests, description, theme, venue_id
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
  "isssssissisisss",
  $customerId, $partyType, $date, $fromTime, $toTime, $musicPartnerId,
  $photoVideoId, $albumStatus, $photoDuration, $foodPartnerId, $foodCategory,
  $guests, $description, $theme, $venueid
);

if ($stmt->execute()) {
    echo "Success";
} else {
    http_response_code(500);
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

