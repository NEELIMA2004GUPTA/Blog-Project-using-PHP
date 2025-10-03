<?php
include 'db.php';

$stmt = $conn->prepare("SELECT id, title, content, created_at FROM posts ORDER BY created_at DESC");
$stmt->execute();
$stmt->bind_result($id, $title, $content, $created_at);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini Blog</title>
</head>
<body>
    <h1>Mini Blog</h1>
    <a href="add.php">Add New Post</a>
    <hr>
    <?php while ($stmt->fetch()) { ?>
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
        <a href="edit.php?id=<?php echo $id; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>">Edit</a> | 
        <a href="delete.php?id=<?php echo $id; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        <hr>
    <?php } ?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
