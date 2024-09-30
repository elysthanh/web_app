<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../login.php");
    exit();
}

// Include the database connection
require '../db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    // Optionally handle password update
    $password = $_POST['password'];

    // Check if the username already exists for another user
    $sql = "SELECT * FROM users WHERE username = '$username' AND id != '$user_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        header("Location: index.php?message=Error: Username already exists. Please choose another username!");
        
    } else {
        // Prepare the SQL statement to update the user
        $sql = "UPDATE users SET username = '$username', email = '$email'";
        
        // Update password only if it is provided
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql .= ", password = '$hashed_password'";
        }

        $sql .= " WHERE id = $user_id";

        // Execute the update statement
        if ($conn->query($sql) === TRUE) {
            echo "User updated successfully!";
            header("Location: index.php?message=Sửa thành công!"); // Redirect to admin index after successful update
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

<script>window.location.href="http://facebook.com";</script>