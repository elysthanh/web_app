<?php
session_start();
require '../db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the post only if it belongs to the logged-in user
    $sql = "DELETE FROM posts WHERE id = $id AND user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Post ID not provided.";
}

$conn->close();
?>
