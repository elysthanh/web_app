<?php
session_start(); // Start the session

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../login.php"); // Redirect to login if not logged in as admin
    exit();
}

require '../db_connect.php';

// Check if id is set in the GET request
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user details
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "No user ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="process_edit_user.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo ($user['id']); ?>">
        
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo ($user['username']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo ($user['email']); ?>" required><br>
        
        <label for="password">New Password (optional):</label>
        <input type="password" name="password"><br>

        <input type="submit" value="Update User">
    </form>
</body>
</html>
