<?php

session_start();

include '../Include/dbconnection.php';

if (isset($_SESSION['ad_id'])) {

    $adminId = $_SESSION['ad_id'];
    $sql = "SELECT name FROM admin WHERE ad_id = $adminId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $userName = $row['Last_Name'];
    }
}



function getCount($table, $conn)
{
    $query = "SELECT COUNT(*) AS count FROM $table";
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return 0;
    }
}


$customerCount = getCount('customer', $conn);
$reservationCount = getCount('reservation', $conn);
$themeCount = getCount('theme', $conn);
$vendorCount = getCount('vendor', $conn);
$venueCount = getCount('venue', $conn);
$adminCount = getCount('admin', $conn);
$feedbackCount = getCount('feedback', $conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="./images/favicon-icon.svg">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('./images/admin5.webp');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 20px;
            transition: background-color 0.5s;
            font-size: large;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }


        .dashboard-container {
            max-width: 1200px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 20px;
            text-align: center;
            z-index: 100;

        }

        .dashboard-box {
            background-color: #fff;
            color: #39004b;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .dashboard-box:hover {
            transform: translateY(-10px);
            color: #660066;
        }

        .dashboard-box i {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2em;
            color: rgba(0, 0, 0, 0.1);
        }

        .dashboard-box h3 {
            font-size: 1.5em;
            color: #000080;
        }

        .dashboard-box h3:hover {
            font-size: 1.5em;
            color: #660066;
        }

        .dashboard-box p {
            font-size: 3em;
            font-weight: bold;
            margin: 0;
        }

        .dashboard-box p:hover {
            font-size: 3em;
            font-weight: bold;
            margin: 0;
            color: #4d004d;
        }

        .logout-link {
            display: block;
            background-color: #39004b;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin: 20px auto;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-decoration: none;
            border-radius: 15px;
            width: 20%;
        }

        .manage {
            display: block;
            background-color: #39004b;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .manage:hover {
            display: block;
            background-color: #003300;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-decoration: wavy;
            color: #EDECE6;
        }

        h1 {
            color: #39004b;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        h1:hover {
            color: #650184;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        .logout-link:hover {
            background-color: #4d004d;
        }

        a {
            font-size: larger;
        }

      
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <h1>Welcome, <?php echo $userName ?></h1>

    <div class="dashboard-container">
        <div class="dashboard-box">
            <i class="fas fa-users"></i>
            <h3>Customer Count</h3>
            <p><?php echo $customerCount; ?></p>
        </div>
        <div class="dashboard-box">
            <i class="fas fa-calendar-alt"></i>
            <h3>Reservation Count</h3>
            <p><?php echo $reservationCount; ?></p>
        </div>
        <div class="dashboard-box">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <h3>Feedback</h3>
            <p><?php echo $feedbackCount; ?></p>
        </div>
        <div class="dashboard-box">
            <i class="fa fa-hashtag" aria-hidden="true"></i>
            <h3>Theme</h3>
            <p><?php echo $themeCount; ?></p>
        </div>
        <div class="dashboard-box">
            <i class="fa fa-ship" aria-hidden="true"></i>
            <h3>Vendors</h3>
            <p><?php echo $vendorCount; ?></p>
        </div>
        <div class="dashboard-box">
            <i class="fa fa-map-pin" aria-hidden="true"></i>
            <h3>Venue</h3>
            <p><?php echo $venueCount; ?></p>
        </div>
        <div class="dashboard-box">
            <i class="fa fa-user-secret" aria-hidden="true"></i>
            <h3>Admin</h3>
            <p><?php echo $adminCount; ?></p>
        </div>
        <div class="dashboard-box">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
            <h3>Users</h3>
            <a href="./viewCustomer.php" class="manage">Check Users</a>
        </div>

        <div class="dashboard-box">
            <i class="fa fa-gift" aria-hidden="true"></i>
            <h3>Vendor</h3>
            <a href="./vendorView.php" class="manage">Check Vendors</a>
        </div>

        <div class="dashboard-box">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            <h3>Reservations</h3>
            <a href="./viewReservation.php" class="manage">Check Reservations</a>
        </div>

        <div class="dashboard-box">
            <i class="fa fa-camera" aria-hidden="true"></i>
            <h3>Theme</h3>
            <a href="./viewTheme.php" class="manage">Check Theme</a>
        </div>

        <div class="dashboard-box">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <h3>Feedback</h3>
            <a href="./viewForm.php" class="manage">Check Feedback</a>
        </div>

        <div class="dashboard-box">
            <i class="fa fa-taxi" aria-hidden="true"></i>
            <h3>Venue</h3>
            <a href="./viewVenue.php" class="manage">Check Venue</a>
        </div>

        <div class="dashboard-box">
            <i class="fa fa-address-book" aria-hidden="true"></i>

            <h3>New Admin</h3>
            <a href="./adminRegister.php" class="manage">Create New Admin</a>
        </div>
    </div>

    <a href="../Pages/Login-Admin/index.php" class="logout-link">Logout</a>
</body>

</html>