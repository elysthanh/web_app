<?php
session_start(); // Start the session

// Include the database connection
require 'db_connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to get user information by username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    // Check if the query returned any results
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password using password_verify()
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];

            // Redirect to admin partition if role_id is 1
            if ($user['role_id'] == 1) {
                header("Location: admin/index.php");
                exit();
            } else {
                header("Location: user/index.php");
                exit();
            }
        } else {
            // Incorrect password
            header("Location: login.php?error=Incorrect username or password");
            exit();
        }
    } else {
        // Username not found
        header("Location: login.php?error=User not found");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
