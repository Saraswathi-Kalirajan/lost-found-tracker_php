<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location:../login.php");
    exit();
}
if(!isset($_GET['id'])){
    echo "Invalid request.";
    exit();
}

$item_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$sql = "UPDATE items SET status='resolved' WHERE id='$item_id' AND user_id='$user_id'";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Resolved</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="marked-card">
<?php
if($conn->query($sql) === TRUE) {
    echo "<p>Item marked as resolved!</p>";
} else {
    echo "<p>Error: " . $conn->error . "</p>";
}
?>
<a href="../dashboard.php" class="back-link">Back To Dashboard</a>
</div>
