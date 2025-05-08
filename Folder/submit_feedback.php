<?php
include '../Include/dbconnection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Last_Name']) && isset($_POST['message'])) {
    $lastName = $_POST['Last_Name'];
    $feedbackText = $_POST['message'];

    // 1. Check if customer exists
    $sql = "SELECT cus_id FROM customer WHERE Last_Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $lastName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $customerId = $row['cus_id'];

        // Insert feedback
        $insertFeedback = $conn->prepare("INSERT INTO feedback (cus_id, message) VALUES (?, ?)");
        $insertFeedback->bind_param("is", $customerId, $feedbackText);

        if ($insertFeedback->execute()) {
            echo "<script>alert('Thank you for your feedback!'); window.location.href='customer-feedback-form.php';</script>";
        } else {
            echo "Error inserting feedback: " . $conn->error;
        }
    } else {
        echo "Customer not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid form submission.";
}
?>
