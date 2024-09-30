<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
<h1>
    <a href="index.php">Trang chủ</a>
    </h1>
<?php
if (isset($_GET['message'])) {
    echo ($_GET['message']);
}
if (isset($_GET['error'])) {
    echo ($_GET['error']);
}
?>
    <h2>Đăng nhập</h2>

    <form action="process_login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" ><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>
