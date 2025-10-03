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
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="left">Blog</div>
        <div class="right">Write. Share. Inspire....</div>
    </div>

    <a class="add-post" href="add.php">Add New Post</a>

    <?php while ($stmt->fetch()) { ?>
        <div class="post">
            <h2><?php echo htmlspecialchars($title); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($content));?></p>
            <div class="actions">
                <a class="edit-btn" href="edit.php?id=<?php echo $id; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>">Edit</a>
                <a class="delete-btn" href="delete.php?id=<?php echo $id; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        </div> 
    <?php } ?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
