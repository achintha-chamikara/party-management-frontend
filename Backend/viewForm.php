<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/favicon-icon.svg">
    <title>Form Data</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('./images/admin5.webp');
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #000000;
            padding: 20px;
            font-size: larger;
        }

        h2 {
            color: #252525;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); 
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #FFEDED; 
            padding: 12px;
            text-align: left;
            color: #000000; 
        }

        th {
            background-color: #6D7FCC; 
            color: #ffffff;
            text-align: center;
        }

        tr:nth(even) {
            background-color: transparent;
            
        }

        tr:hover {
            background-color: rgba(222, 189, 237,0.25);
        }

        .delete-btn {
            cursor: pointer;
            background-color: #f44336; 
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            margin-right: 5px;
            width: auto;
            font-size: large;
        }

        

        .delete-btn:hover {
            opacity: 0.8;
        }

    </style>
</head>

<body>
    <?php
    include '../Include/dbconnection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_form'])) {
        $deleteFormId = $_POST['delete_form_id'];

        $deleteSql = "DELETE FROM feedback WHERE feedback_id = $deleteFormId";

        if ($conn->query($deleteSql) === TRUE) {
            $deleteMessage = 'Row Deleted Successfully';
        } else {
            $deleteMessage = 'Error deleting record: ' . $conn->error;
        }
    }

    $formSql = "SELECT * FROM feedback";
    $formResult = $conn->query($formSql);

    $formRows = array();
    if ($formResult->num_rows > 0) {
        while ($formRow = $formResult->fetch_assoc()) {
            $formRows[] = $formRow;
        }
    }

    $conn->close();
    ?>

    <h2>Form Data</h2>
    <?php if (!empty($formRows)) : ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Customer ID</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($formRows as $formRow) : ?>
                <tr>
                    <td><?php echo $formRow['feedback_id']; ?></td>
                    <td><?php echo $formRow['message']; ?></td>
                    <td><?php echo $formRow['cus_id']; ?></td>
                    <td>
                        <button class="delete-btn" onclick="deleteFormRow(<?php echo $formRow['feedback_id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>
    <?php
        include './back.php'
        ?>

    <script>
        function deleteFormRow(formId) {
            if (confirm('Are you sure you want to delete this row?')) {
                var deleteForm = document.createElement('form');
                deleteForm.method = 'post';
                deleteForm.action = window.location.href; 

                var formIdInput = document.createElement('input');
                formIdInput.type = 'hidden';
                formIdInput.name = 'delete_form_id';
                formIdInput.value = formId;

                var submitBtn = document.createElement('button');
                submitBtn.type = 'submit';
                submitBtn.name = 'delete_form';
                submitBtn.style.display = 'none';
                deleteForm.appendChild(formIdInput);
                deleteForm.appendChild(submitBtn);

                document.body.appendChild(deleteForm);
                submitBtn.click();
            }
        }
    </script>
</body>

</html>