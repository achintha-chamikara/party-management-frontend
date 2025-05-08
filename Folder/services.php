<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Cards</title>
  <style>
    body {
      margin: 0;
      padding: 20px;
      font-family: Arial, sans-serif;
      background-image: url('../Backend/images/s2.jpg');
      background-size: cover;
    }

    h1 {
      text-align: center;
      margin-bottom: 40px;
      color: #ffffff;
    }

    h3{
        color: #59037a;
    }
    .card-container {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
    }

    .card {
      background-color: #fff;
      width: 300px;
      border-radius: 8px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .card-content {
      padding: 15px;
      flex-grow: 1;
    }

    .card-footer {
      padding: 10px;
      text-align: center;
      background-color: #fbfbfc;
    }

    .card-footer button {
      background-color: #fff;
      color: #007bff;
      border: 2px solid #007bff;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .card-footer button:hover {
      background-color: #007bff;
      color: #fff;
    }

    .cta-section {
  text-align: center;
  margin-top: 60px;
}

.cta-section h2 {
  color: white;
  font-size: 24px;
  margin-bottom: 20px;
}

.cta-button {
  background-color: #fff;
  color: #28a745;
  border: 2px solid #28a745;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
  transition: all 0.3s ease;
}

.cta-button:hover {
  background-color: #28a745;
  color: #fff;
}

  </style>
</head>
<body>
  <h1>OUR SERVICES</h1>

  <div class="card-container">
    <div class="card">
      <img src="../Backend/images/rainbowfirstbirthdayparty.jpg" alt="Theme">
      <div class="card-content">
        <h3>THEME</h3>
        <p>Choose your favourite theme.</p>
      </div>
      <div class="card-footer">
        <button onclick="goToTheme()">View More</button>
      </div>
    </div>

    <div class="card">
      <img src="../Backend/images/001.jpg" alt="Venue">
      <div class="card-content">
        <h3>VENUE</h3>
        <p>choose your favourite place.</p>
      </div>
      <div class="card-footer">
        <button onclick="goToVenue()">View More</button>
      </div>
    </div>

    <div class="card">
      <img src="../Backend/images/party-decorations.jpg" alt="Vendors">
      <div class="card-content">
        <h3>VENDORS</h3>
        <p>Choose vendord for make your day more beautiful.</p>
      </div>
      <div class="card-footer">
        <button onclick="goToVendors()">View More</button>
      </div>
    </div>
  </div>

 
    <div class="cta-section">
      <h2>Would you like to make a reservation?</h2>
      <button class="cta-button" onclick="goToReservation()">Click Here</button>
    </div>

    <?php
        include '../Backend/back.php'
        ?>
  
  <script>
    function viewMore(name) {
      alert("You clicked View More on: " + name);
    }

    function goToTheme() {
      window.location.href = "themeView.php";
    }

    function goToVenue() {
      window.location.href = "venueView.php";
    }

    function goToVendors() {
      window.location.href = "vendorsView.php";
    }

    function goToReservation() {
  window.location.href = "reservationForm.php"; 
}



  </script>
</body>
</html>
