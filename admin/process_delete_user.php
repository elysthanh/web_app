<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../login.php"); // Redirect to login if not logged in as admin
    exit();
}

// Include the database connection
require '../db_connect.php';

// Check if id is set in the GET request
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        // User deleted successfully
        header("Location: index.php?message=User deleted successfully.");
        exit();
    } else {
        // Error deleting the user
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No user ID provided.";
}

// Close the database connection
$conn->close();
?>
