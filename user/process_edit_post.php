<?php
session_start();
require '../db_connect.php';

// Check if the request method is GET and id is set
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $user_id = $_SESSION['user_id']; // Retrieve the user_id from session

    // Correct the SQL query: Use AND instead of a comma
    $sql = "SELECT * FROM posts WHERE id = $post_id AND user_id = $user_id"; // Ensure the post belongs to the logged-in user
    $result = $conn->query($sql);

    // Check if the post exists
    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "Post not found or you don't have permission to edit this post.";
        exit;
    }
}

// Handle form submission for updating the post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $photo = ''; // Initialize photo variable
    $photo_updated = false; // Flag to check if photo is updated

    // Handle file upload if a new file is selected
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "photos/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $photo = basename($_FILES["photo"]["name"]);
                $photo_updated = true; // Set flag to true if photo is uploaded
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Prepare the SQL statement to update the post
    if ($photo_updated) {
        // Update the post with new photo
        $sql = "UPDATE posts SET title='$title', content='$content', photo='$photo' WHERE id=$post_id AND user_id = $user_id"; // Make sure user_id is checked
    } else {
        // Update the post without changing the photo
        $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$post_id AND user_id = $user_id"; // Make sure user_id is checked
    }

    // Execute the statement
    if ($conn->query($sql) === TRUE) {
        echo "Post updated successfully!";
        header("Location: index.php"); // Redirect to user index page after update
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="process_edit_post.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="post_id" value="<?php echo ($post['id']); ?>">
        
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo ($post['title']); ?>" required><br>

        <label for="content">Content:</label>
        <textarea name="content" required><?php echo ($post['content']); ?></textarea><br>
        
        <label for="photo">Upload New Image (optional):</label>
        <input type="file" name="photo" accept="image/*"><br>

        <input type="submit" value="Update Post">
    </form>
</body>
</html>
