<?php
include 'Include/dbconnection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Last_Name'])) {
    // Get POST data safely
    $date = $_POST['date'] ?? '';
    $fromTime = $_POST['time_from'] ?? '';
    $toTime = $_POST['time_to'] ?? '';
    $partyType = $_POST['party_type'] ?? '';
    $description = $_POST['description'] ?? '';
    $guests = intval($_POST['no_of_guests'] ?? 0);
    $customerLastName = trim($_POST['Last_Name']);
    $musicId = $_POST['vendor_music_id'] ?? '';
    $photoVideoId = $_POST['vendor_photo_id'] ?? '';
    $foodPartnerId = $_POST['vendor_food_id'] ?? '';
    $venueid = $_POST['venue_id'] ?? '';
    $themeid = $_POST['theme_id'] ?? '';

    // 1. Check if customer exists
    $sql = "SELECT cus_id FROM customer WHERE Last_Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $customerLastName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $customerId = $row['cus_id'];
        $admin_id = 1;

        // Insert reservation
        $insertReservation = $conn->prepare("INSERT INTO reservation (
            date, time_from, time_to, party_type, description, no_of_guests, cus_id,
            vendor_music_id, vendor_photo_id, vendor_food_id, venue_id, theme_id, admin_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $insertReservation->bind_param(
            "sssssiiiiiiii",
            $date, $fromTime, $toTime, $partyType, $description, $guests, $customerId,
            $musicId, $photoVideoId, $foodPartnerId, $venueid, $themeid, $admin_id
        );

        if ($insertReservation->execute()) {
            echo "<script>alert('Reservation successfully submitted!'); window.location.href='reservationForm.php';</script>";
        } else {
            echo "Error inserting reservation: " . $conn->error;
        }

        $insertReservation->close();
    } else {
        echo "Customer not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid form submission.";
}
?>

