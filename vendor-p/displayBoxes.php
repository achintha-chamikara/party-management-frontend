//backend
<?php

include('../../Include/dbconnection.php');
$sql = "SELECT * FROM vendor";
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
  <h1>VENDOR</h1>
<?php if ($result->num_rows > 0): ?>
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="database-box" onclick="saveAndRedirect(<?= $row['id'] ?>)">
      <?= $row['name'] ?>
        <h5><?= $row['description'] ?></h5>


    </div>
  <?php endwhile; ?>
<?php endif; ?>

<script>
function saveAndRedirect(vendorId) {
  const formData = new FormData();
  formData.append('vendor_id', vendorId);

  fetch('saveClick.php', {
    method: 'POST',
    body: formData,
  })
  .then(response => {
    if (response.ok) {
      window.location.href = "../venue-p/displayBoxes.php";
    } else {
      alert('Error saving click.');
    }
  })
  .catch(error => console.error('Error:', error));
}

</script>

</body>
</html>
