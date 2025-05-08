<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/favicon-icon.svg">
    <title>User Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #FFEBEB;
            margin: 0;
            padding: 20px;
            background-image: url('./images/admin5.webp');
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            font-size: larger;
        }

        h2 {
            color: #39004b;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #393939;
            padding: 12px;
            text-align: left;
            color: #000000;
        }

        th {
            background-color: #6D7FCC;
            color: #ffffff;
        }

        tr:nth(even) {
            background-color: #333333;
         
        }

        tr:hover {
            background-color:rgba(248, 211, 228, 0.3);
        }

        .edit-popup,
        .overlay {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 2;
            color: #000;
            border-radius: 8px;
            background-color:rgba(248, 211, 228, 0.9);
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        button {
            background-color: #39004b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-right: 5px;
            width: auto;
            font-size: large;
        }

        button:hover {
            background-color: #51006A;
        }

        .delete-button {
            background-color: #f44336;
        }

        .delete-button:hover {
            background-color: #e53935;
        }
    </style>


</head>

<body>
    <?php
    include '../Include/dbconnection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
        $deleteUserId = $_POST['delete_user_id'];

        $deleteSql = "DELETE FROM customer WHERE cus_id = $deleteUserId";

        if ($conn->query($deleteSql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    $sql = "SELECT * FROM customer";
    $result = $conn->query($sql);

 
    $rows = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    $conn->close();
    ?>

    <h2>User Data</h2>
    <?php if (!empty($rows)) : ?>
        <table>
            <tr>
                <th>ID</th>
                <th>First_Name</th>
                <th>Last_Name</th>
                <th>Age</th>
                <th>UserName</th>
                <th>Admin ID</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?php echo $row['cus_id']; ?></td>
                    <td><?php echo $row['First_Name']; ?></td>
                    <td><?php echo $row['Last_Name']; ?></td>
                    <td><?php echo $row['Age']; ?></td>                    
                    <td><?php echo $row['UserName']; ?></td>
                    <td><?php echo $row['admin_id']; ?></td>
                    <td>
                        <button onclick="openDeletePopup(<?php echo $row['cus_id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="overlay" id="deleteOverlay"></div>
        <div class="edit-popup" id="deletePopup">
            <h3>Delete User</h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="delete_user_id" id="deleteUserId" value="">
                <p>Are you sure you want to delete this user?</p>
                <button type="submit" name="delete_user">Yes</button>
                <button type="button" onclick="closeDeletePopup()">No</button>
            </form>
        </div>

    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>
    <?php
        include './back.php'
        ?>
    <!-- JS -->
    <script>
        function openDeletePopup(userId) {
            document.getElementById('deleteUserId').value = userId;

            document.getElementById('deletePopup').style.display = 'block';
            document.getElementById('deleteOverlay').style.display = 'block';
        }

        function closeDeletePopup() {
            
            document.getElementById('deletePopup').style.display = 'none';
            document.getElementById('deleteOverlay').style.display = 'none';
        }
    </script>

</body>

</html>