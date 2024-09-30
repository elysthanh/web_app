<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}
if($_SESSION['role_id'] == 1){
    header("location: ../admin/index.php");
}
// Retrieve user information from session
 $user_id = $_SESSION['user_id'];
 $username = $_SESSION['username'];

// Include the database connection
require '../db_connect.php';
// var_dump($_SESSION['username']);
// Fetch posts created by the user without using prepared statements
$sql = "SELECT * FROM posts WHERE user_id = $user_id"; // Directly using the variable
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Dashboard</title>
    </head>
    <body>
    <h1>
    <a href="../index.php">Trang chủ</a>
    </h1>
        <h2>Welcome, <?php echo ($_SESSION['username']); ?>!</h2>
        <h2>User ID: <?php echo ($_SESSION['user_id']); ?></h2>

        <p>Quản lý bài viết</p>
        <a href="insert.php">Thêm Bài Viết</a>
        <table border="1" width="100%">
            <tr>
                <th>Mã</th>
                <th>Tiêu đề</th>
                <th>Ảnh</th>
                <th>Nội dung</th>
                <th>Ngày tạo</th>
                <th>Sửa</th>
                <th>Xoá</th>
            </tr>
            <?php
            while ($each = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo ($each['id']); ?></td>
                    <td><?php echo ($each['title']); ?></td>
                    <td>
                        <?php if (!empty($each['photo'])): ?>
                            <img src="photos/<?php echo ($each['photo']); ?>" height="100">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?php echo ($each['content']); ?></td>
                    <td><?php echo ($each['created_at']); ?></td>
                    <td>
                        <a href="process_edit_post.php?id=<?php echo ($each['id']);?>&user_id=<?php echo ($_SESSION['user_id']);?>">Sửa</a>
                    </td>
                    <td>
                        <a href="process_delete_post.php?id=<?php echo ($each['id']);?>&user_id=<?php echo ($_SESSION['user_id']);?>">Xoá</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
