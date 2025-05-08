<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Feedback Form</title>

  <style>
    body {
      background-image: url('Backend/images/party.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      color: #fff;
    }

    .form-container {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 30px;
      border-radius: 10px;
      max-width: 400px;
      margin: 100px auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    form input, form textarea, form button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: none;
      border-radius: 5px;
    }

    form button {
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
      margin-top: 10px;
    }

    form button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>

  <div class="form-container">
    <h1>Customer Feedback</h1>

    <form action="submit_feedback.php" method="POST">
      
        <label for="name">Your Name:</label><br>
        <input type="text" name="Last_Name" id="Last_Name" required><br><br>
      <label for="feedback">Your Feedback:</label><br>
      <textarea name="message" id="message" rows="4" required></textarea><br><br>

      <button type="submit">Submit</button> <br><br>
           
  <?php
        include 'Backend/back.php'
        ?>

    </form>
  </div>

  
  <script src="feedback.js"></script>
</body>
</html>

