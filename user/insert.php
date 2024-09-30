<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bài Viết</title>
</head>
<body>
    <h1>Thêm Bài Viết</h1>
    <form action="process_add_post.php" method="post" enctype="multipart/form-data">
        <label for="title">Tên:</label>
        <input type="text" name="title" required><br>
        
        <label for="content">Nội dung:</label>
        <textarea name="content" required></textarea><br>
        
        <label for="photo">Ảnh:</label>
        <input type="file" name="photo" accept="image/*"><br>

        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"> 
        
        <input type="submit" value="Thêm">
    </form>
</body>
</html>
<script>alert</script>