<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - Party Planning System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* General styling */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #f8e8ff, #fff0f5);
      color: #333;
    }

    /* Header section */
    header {
      background-color: #620a5e;
      color: white;
      padding: 20px;
      text-align: center;
    }

    /* About section */
    .about-section {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .about-section h2 {
      color: #3d0655;
      margin-bottom: 15px;
    }

    .about-section p {
      font-size: 1.1rem;
      line-height: 1.6;
    }

   
  </style>
</head>
<body>

  <header>
    <h1>Vibe Makers</h1>
    <p>Your dream event, perfectly planned.</p>
  </header>

  <div class="about-section">
    <h2>About Us</h2>
    <p>
      At Vibe Makers, we specialize in creating unforgettable moments. From birthdays and weddings to corporate galas and themed parties, our team delivers seamless, elegant, and custom-tailored events that match your vision. 
    </p>
    <p>
      Our Party Planning System helps clients browse event packages, book services, and track their event progress—all in one place. With experienced planners and creative decorators, we bring your ideas to life with style and professionalism.
    </p>

    <?php
        include 'Backend/back.php'
        ?>

   
</body>
</html>
