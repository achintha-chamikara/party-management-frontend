<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reservation Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('Backend/images/party.jpg');
      background-size: cover;
      background-position: center;
      margin: 0;
      padding: 0;
    }

    .form-container {
      background: rgba(14, 5, 5, 0.87);
      max-width: 800px;
      margin: 50px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px #00000060;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: white;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
      color: white;
    }

    input, select, textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #aaa;
      border-radius: 5px;
    }

    button {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }
    .btn-secondary {
  background-color: #04070a;
  border-color: #6c757d;
}

.btn-secondary:hover {
  background-color: #6fb4e9;
  border-color: #545b62;
}

  </style>
</head>
<body>
<?php
include 'Include/dbconnection.php';

// Function to fetch vendors by category
function getVendorsByCategory($conn, $category) {
    $vendors = [];
    $stmt = $conn->prepare("SELECT vendor_id, name FROM vendor WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $vendors[] = $row;
    }
    return $vendors;
}

$musicVendors = getVendorsByCategory($conn, 'music');
$photoVendors = getVendorsByCategory($conn, 'photography');
$foodVendors  = getVendorsByCategory($conn, 'food');

// Fetch venues
function getVenues($conn) {
  $venues = [];
  $sql = "SELECT venue_id, name FROM venue";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
      $venues[] = $row;
  }
  return $venues;
}

// Fetch themes
function getThemes($conn) {
  $themes = [];
  $sql = "SELECT theme_id, name FROM theme";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
      $themes[] = $row;
  }
  return $themes;
}

$venues = getVenues($conn);
$themes = getThemes($conn);

?>


  <div class="form-container">
    <h2>Reservation Form</h2>
    <form id="reservationForm" method="post">

      <label for="date">Date:</label>
      <input type="date"  name="date" id="date" required>

      <label>From:</label>
      <input type="time" name="time_from" id="fromTime" required>

      <label>To:</label>
      <input type="time" name="time_to" id="toTime" required>

      <label for="party_type">Party Type:</label>
      <select name="party_type" id="partyType" required>
        <option value="">Select</option>
        <option>Wedding</option>
        <option>Homecoming</option>
        <option>Birthday</option>
        <option>Engagement</option>
        <option>Other</option>
      </select>

      <label for="description">Description:</label>
      <textarea name="description" id="description" rows="3"></textarea>

      <label for="no_of_guests">Number of Guests:</label>
      <input type="number" name="no_of_guests" id="guests" min="1" required>

      <label for="Last_Name">Your Last Name:</label><br>
        <input type="text" name="Last_Name" id="Last_Name" required><br><br>


      <!-- Music Vendor -->
    <label for="vendor_music_id">Music Partner:</label>
    <select name="vendor_music_id" id="vendor_music_id" required>
      <option value="">Select Music Vendor</option>
      <?php foreach ($musicVendors as $vendor): ?>
        <option value="<?= $vendor['vendor_id'] ?>"><?= htmlspecialchars($vendor['name']) ?></option>
      <?php endforeach; ?>
    </select>

    <!-- Photography Vendor -->
    <label for="vendor_photo_id">Photography & Videography Partner:</label>
    <select name="vendor_photo_id" id="vendor_photo_id" required>
      <option value="">Select Photo Vendor</option>
      <?php foreach ($photoVendors as $vendor): ?>
        <option value="<?= $vendor['vendor_id'] ?>"><?= htmlspecialchars($vendor['name']) ?></option>
      <?php endforeach; ?>
    </select>

    <!-- Food Vendor -->
    <label for="vendor_food_id">Food Partner:</label>
    <select name="vendor_food_id" id="vendor_food_id" required>
      <option value="">Select Food Vendor</option>
      <?php foreach ($foodVendors as $vendor): ?>
        <option value="<?= $vendor['vendor_id'] ?>"><?= htmlspecialchars($vendor['name']) ?></option>
      <?php endforeach; ?>
    </select>

<!-- Venue Dropdown -->
<label for="venue_id">Venue:</label>
<select name="venue_id" id="venue_id" required>
  <option value="">Select Venue</option>
  <?php foreach ($venues as $venue): ?>
    <option value="<?= $venue['venue_id'] ?>"><?= htmlspecialchars($venue['name']) ?></option>
  <?php endforeach; ?>
</select>

<!-- Theme Dropdown -->
<label for="theme_id">Theme:</label>
<select name="theme_id" id="theme_id" required>
  <option value="">Select Theme</option>
  <?php foreach ($themes as $theme): ?>
    <option value="<?= $theme['theme_id'] ?>"><?= htmlspecialchars($theme['name']) ?></option>
  <?php endforeach; ?>
</select>

      <button type="submit">Submit Reservation</button><br><br>
      </form>
       
  <<?php
        include 'Backend/back.php'
        ?>
</div>

    


<script>
document.getElementById('reservationForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch('resevation_dbconnect.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(response => {
    alert(response);
    if (response.includes("Successfully")) {
      document.getElementById('reservationForm').reset();
    }
  })
  .catch(error => {
    console.error('Submission failed:', error);
    alert('Failed to submit reservation.');
  });
});
</script>


  
</body>
</html>
