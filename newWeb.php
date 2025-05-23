<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Cards</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Custom Navbar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="myweb.css"/>
  <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonymous"></script>
  
</head>
<body>

 
  <nav class="navbar">
    <div class="navbar-left">
      <img src="Backend/images/L1.png" alt="Logo" class="logo">
      <span class="company-name">Vibe Makers</span>
      
    </div>

    <div class="navbar-toggle" id="menuToggle">&#9776;</div>

    <div class="navbar-links" id="navLinks">
      <a href="Folder/abouts.php">About</a>
      <a href="Folder/customer-feedback-form.php">Feedback</a>
      <button class="login-btn" onclick="goToLogin()">Login</button>
    </div>
  </nav>
  

  <div class="card text-bg-dark custom-card">
    <img src="Backend/images/s2.jpg" class="card-img" alt="Card image">
    <div class="card-img-overlay">
      <h1>Welcome to Vibe Makers</h1>
    </div>
  </div>


  <br>  
  <h2>Our Galary</h2>
  <br>
  
  <div class="carousel-wrapper">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Backend/images/g5.jpg" class="d-block w-100" alt="wedding">
        </div>
        <div class="carousel-item">
          <img src="Backend/images/g4.jpg" class="d-block w-100" alt="dance">
        </div>
        <div class="carousel-item">
          <img src="Backend/images/g3.jpg" class="d-block w-100" alt="unicorn">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <br><br> <br><br> 

  <footer>
    <div class="container">
        <div class="footer-content">
            <h3>Contact Us</h3>
            <p>Email:Info@example.com</p>
            <p>Phone:+121 56556 565556</p>
            <p>Address:Your Address 123 street</p>
        </div>
        <div class="footer-content">
            <h3>Quick Links</h3>
             <ul class="list">
                <li><a href="">Home</a></li>
                <li><a href="Folder/abouts.php">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Products</a></li>
             </ul>
        </div>
        <div class="footer-content">
            <h3>Follow Us</h3>
            <ul class="social-icons">
             <li><a href=""><i class="fab fa-facebook"></i></a></li>
             <li><a href=""><i class="fab fa-twitter"></i></a></li>
             <li><a href=""><i class="fab fa-instagram"></i></a></li>
             <li><a href=""><i class="fab fa-linkedin"></i></a></li>
            </ul>
            </div>
    </div>
    <div class="bottom-bar">
        <p>&copy; 2023 your company . All rights reserved</p>
    </div>
</footer>

<script>
  

  function goToLogin() {
    window.location.href = "Folder/logpage.php";
  }



</script>

  <script src="script.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
