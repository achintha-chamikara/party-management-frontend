<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="./images/favicon-icon.svg" />
    <title>Theme Data</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('./images/admin5.webp');
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #333;
            padding: 20px;
            font-size: large;
        }

        h2 {
            color: #4B0082;
            text-align: center;
            transition: color 0.3s ease;
            font-size: xx-large;
        }

        h2:hover {
            color: #9370DB;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }

        th,
        td {
            border: 1px solid #393939;
            padding: 12px;
            text-align: left;
            background-color: transparent;
            transition: background-color 0.3s ease;
        }

        th {
            background-color: #d699ff;
            color: #ffffff;
        }

        td {
            color: #333;
        }

        tr:nth-child(even) {
            background-color: transparent;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        button {
            cursor: pointer;
            background-color: #39004b;
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            margin-top: 10px;
            margin-right: 10px;
            align-items: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            width: auto;
            font-size: large;
        }

        button:hover {
            background-color: #4B0082;
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .edit-popup,
        .overlay {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(234, 249, 252, 0.9);
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.9);
            z-index: 2;
            border-radius: 10px;
            transition: all 0.3s ease;
            animation: zoomIn 0.3s ease-in-out;
        }

        .overlay {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 0;
            padding: 0;
            box-shadow: none;
            animation: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        input[type="text"] {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 10px;
            width: calc(100% - 22px);
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #4B0082;
            outline: none;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form button[type="submit"] {
            background-color: #39004b;
            color: #fff;
        }

        form button[type="button"] {
            background-color: #6c757d;
            color: #fff;
        }

        form button[type="submit"]:hover,
        form button[type="button"]:hover {
            background-color: #2e003a; /* darker shade of #39004b */
        }
    </style>
</head>

<body>
    <?php
    include '../Include/dbconnection.php';

    // Handle Edit Theme
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_theme'])) {
        $editThemeId = $_POST['edit_theme_id'];
        $editThemeName = $_POST['edit_theme_name'];
        $editThemeDescription = $_POST['edit_theme_description'];

        $stmt = $conn->prepare("UPDATE theme SET name = ?, description = ? WHERE theme_id = ?");
        $stmt->bind_param("ssi", $editThemeName, $editThemeDescription, $editThemeId);

        if ($stmt->execute()) {
            echo "<script>alert('Record updated successfully');</script>";
        } else {
            echo "<script>alert('Error updating record: " . htmlspecialchars($stmt->error) . "');</script>";
        }
        $stmt->close();
    }

    // Handle Delete Theme
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_theme'])) {
        $deleteThemeId = $_POST['delete_theme_id'];

        $stmt = $conn->prepare("DELETE FROM theme WHERE theme_id = ?");
        $stmt->bind_param("i", $deleteThemeId);

        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully');</script>";
        } else {
            echo "<script>alert('Error deleting record: " . htmlspecialchars($stmt->error) . "');</script>";
        }
        $stmt->close();
    }

    // Handle Add Theme
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_theme'])) {
        $addThemeName = $_POST['add_theme_name'];
        $addThemeDescription = $_POST['add_theme_description'];
        $addThemeAdminId = $_POST['add_theme_admin_id'];

        $stmt = $conn->prepare("INSERT INTO theme (name, description, admin_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $addThemeName, $addThemeDescription, $addThemeAdminId);

        if ($stmt->execute()) {
            echo "<script>alert('Record added successfully');</script>";
        } else {
            die("Error adding record: " . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    }

    // Fetch all themes
    $sql = "SELECT * FROM theme";
    $result = $conn->query($sql);

    $rows = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    $conn->close();
    ?>

    <h2>Theme Data</h2>
    <?php if (!empty($rows)) : ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Admin ID</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['theme_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['admin_id']); ?></td>
                    <td>
                        <button onclick="openEditPopup(<?php echo htmlspecialchars($row['theme_id']); ?>)">Edit</button>
                        <button onclick="openDeletePopup(<?php echo htmlspecialchars($row['theme_id']); ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Edit Popup -->
        <div class="overlay" id="editOverlay"></div>
        <div class="edit-popup" id="editPopup">
            <h3>Edit Theme</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="edit_theme_id" id="editThemeId" value="" />
                Name: <input type="text" name="edit_theme_name" id="editThemeName" required /><br />
                Description: <input type="text" name="edit_theme_description" id="editThemeDescription" required /><br />
                <button type="submit" name="edit_theme">Save</button>
                <button type="button" onclick="closeEditPopup()">Cancel</button>
            </form>
        </div>

        <!-- Delete Popup -->
        <div class="overlay" id="deleteOverlay"></div>
        <div class="edit-popup" id="deletePopup">
            <h3>Delete Theme</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="delete_theme_id" id="deleteThemeId" value="" />
                <p>Are you sure you want to delete this theme?</p>
                <button type="submit" name="delete_theme">Yes</button>
                <button type="button" onclick="closeDeletePopup()">No</button>
            </form>
        </div>

        <!-- Add Popup -->
        <div class="overlay" id="addOverlay"></div>
        <div class="edit-popup" id="addPopup">
            <h3>Add Theme</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                Name: <input type="text" name="add_theme_name" required /><br />
                Description: <input type="text" name="add_theme_description" required /><br />
                Admin ID: <input type="text" name="add_theme_admin_id" required /><br />
                <button type="submit" name="add_theme">Add</button>
                <button type="button" onclick="closeAddPopup()">Cancel</button>
            </form>
        </div>

        <button onclick="openAddPopup()">Add New Theme</button>

        <?php include './back.php'; ?>

    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>

    <script>
        // Pass PHP array to JS
        const themes = <?php echo json_encode($rows); ?>;

        function openEditPopup(themeId) {
            const theme = themes.find(t => t.theme_id == themeId);
            if (theme) {
                document.getElementById('editThemeId').value = theme.theme_id;
                document.getElementById('editThemeName').value = theme.name;
                document.getElementById('editThemeDescription').value = theme.description;

                document.getElementById('editPopup').style.display = 'block';
                document.getElementById('editOverlay').style.display = 'block';
            }
        }

        function closeEditPopup() {
            document.getElementById('editPopup').style.display = 'none';
            document.getElementById('editOverlay').style.display = 'none';
        }

        function openDeletePopup(themeId) {
            document.getElementById('deleteThemeId').value = themeId;

            document.getElementById('deletePopup').style.display = 'block';
            document.getElementById('deleteOverlay').style.display = 'block';
        }

        function closeDeletePopup() {
            document.getElementById('deletePopup').style.display = 'none';
            document.getElementById('deleteOverlay').style.display = 'none';
        }

        function openAddPopup() {
            document.getElementById('addPopup').style.display = 'block';
            document.getElementById('addOverlay').style.display = 'block';
        }

        function closeAddPopup() {
            document.getElementById('addPopup').style.display = 'none';
            document.getElementById('addOverlay').style.display = 'none';
        }
    </script>
</body>

</html>