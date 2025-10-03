<?php


include 'db.php';

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT id, title, content FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
$stmt->close();

if (!$post) {
    die("Post not found");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed");
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssi", $title, $content, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>
        <textarea name="content" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>
        <button type="submit">Update Post</button>
    </form>
    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
