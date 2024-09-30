<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    <h1>Add New User</h1>
    <form action="process_add_user.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        
        <input type="submit" value="Add User">
    </form>
    <a href="index.php">Back to User Management</a>
</body>
</html>
