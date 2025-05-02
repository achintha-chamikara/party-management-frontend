

<?php
session_start();

include('../../Include/connectin.php');


$venue_id = $_POST['venue_id'];


$sql = "UPDATE reservation SET  venue_id=? ORDER BY id DESC LIMIT 1";

$stmt = $conn->prepare($sql);


if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $venue_id) ;


if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}


$stmt->close();
$conn->close();

header("Location: ../venue-p/displayBoxes.php");
exit();
?>

