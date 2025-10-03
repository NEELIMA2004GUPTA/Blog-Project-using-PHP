<?php

include 'db.php';

$id = intval($_GET['id']);

if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed");
}

$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: index.php');
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
