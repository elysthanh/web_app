<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['message'])) {
    echo ($_GET['message']);
}

require '../db_connect.php';

// Fetch all users from the database
$sql = "SELECT * FROM users WHERE role_id != 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>
    <a href="../index.php">Trang chủ</a>
    </h1>
    <h2>Admin: Quản lý Users</h2>
    <a href="insert_user.php">Thêm</a>
    <table border="1" width="100%">
        <tr>
            <th>Mã</th>
            <th>Username</th>
            <th>Email</th>
            <th>Sửa</th>
            <th>Xoá</th>
        </tr>
        <?php
        // Display each user
        if ($result->num_rows > 0) {
            while ($user = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo ($user['id']); ?></td>
                    <td><?php echo ($user['username']); ?></td>
                    <td><?php echo ($user['email']); ?></td> 
                    <td>
                        <a href="edit_user.php?id=<?php echo ($user['id']); ?>">Sửa</a>
                    </td>
                    <td>
                        <a href="process_delete_user.php?id=<?php echo ($user['id']); ?>">Xoá</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='5'>No users found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$conn->close();
?>
