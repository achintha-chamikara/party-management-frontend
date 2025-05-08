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
      background-image: url('s2.jpg');
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
      gap: 50px;
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
  </style>
</head>
<body>
  <h1>LOGIN</h1>

  <div class="card-container">
    <div class="card">
      <img src="Backend/images/admin.jpg" alt="Theme">
      <div class="card-content">
       
      </div>
      <div class="card-footer">
        <button onclick="goToAdmin()">Admin Login</button>
      </div>
    </div>

    <div class="card">
      <img src="Backend/images/user.jpg" alt="Venue">
      <div class="card-content">
       
      </div>
      <div class="card-footer">
        <button onclick="goToUser()">User Login</button>
      </div>

    </div>
   

  <script>
    function viewMore(name) {
      alert("You clicked View More on: " + name);
    }

   
    function goToAdmin() {
      window.location.href = "adminsignin.php";
    }

    function goToUser() {
      window.location.href = "signing.php";
    }



  </script>


</body>
</html>
