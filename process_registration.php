<?php
// Initialize variables to hold form data and error messages
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    if ($password != $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // Proceed if no errors
    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'web_app');

        // Check if the connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the username or email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Username or Email already exists.";
        } else {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (username, password, email, role_id) VALUES (?, ?, ?, ?)");
            $role_id = 2; // Assuming 2 is the role ID for regular users
            $stmt->bind_param("sssi", $username, $hashed_password, $email, $role_id);

            if ($stmt->execute()) {          
                header("Location: login.php?message=Đăng ký tài khoản thành công");              
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>
