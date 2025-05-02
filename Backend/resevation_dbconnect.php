<?php
include('../../Include/dbconnection.php');
$sql = "SELECT * FROM theme";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <title>Display Boxes</title>


</head>
<body>
  <h1>RESERVATION</h1>
<?php if ($result->num_rows > 0): ?>
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="database-box" onclick="saveAndRedirect(<?= $row['id'] ?>)">
      <?= $row['name'] ?>
        <h5><?= $row['description'] ?></h5>

    </div>
  <?php endwhile; ?>
<?php endif; ?>

<script>
function saveAndRedirect(themeId) {
  const formData = new FormData();
  formData.append('theme_id', themeId);

  
}

</script>

</body>
</html>
// Get POST data

$date = $_POST['date'];
$fromTime = $_POST['time_from'];
$toTime = $_POST['time_to'];
$partyType = $_POST['party_type'];
$description = $_POST['description'];
$guests = $_POST['no_of_guests'];
$customerId = $_POST['cus_id'];
$adminId = $_POST['admin_id'];
$musicId = $_POST['vendor_music_id'];
$photoVideoId = $_POST['vendor_photo_id'];
$foodPartnerId = $_POST['vendor_food_id'];
$venueid = $_POST['venue_id'];
$themeid = $_POST['theme_id'];

// SQL insert (modify the table and field names based on your actual DB)
$sql = "INSERT INTO reservation (
   date, time_from, time_to, party_type,description, no_of_guests, cus_id, admin_id,
    vendor_music_id, vendor_photo_id,
    vendor_food_id, venue_id, theme_id
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
  "isssssissisisss",
  $date, $fromTime, $toTime,$partyType, $description,  $guests, $customerId, $adminId, $musicId,
  $photoVideoId, $foodPartnerId,  $venueid,$themeid
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

