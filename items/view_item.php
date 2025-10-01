<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location:../login.php");
    exit();
}
if(!isset($_GET['id'])){
    echo "Invalid Request.";
    exit();

}
$item_id = intval($_GET['id']);

$sql = "SELECT items.*, users.name AS reporter
        FROM items
        JOIN users ON items.user_id = users.id
        WHERE items.id = $item_id";
$result = $conn->query($sql);


if($result->num_rows == 0){
    echo "Item Not Found.";
    exit();
}

$item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Item</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="item-card">
    <h1><?php echo htmlspecialchars($item['title']); ?></h1>

<p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($item['description'])); ?></p>

<p><strong>Category:</strong> <?php echo htmlspecialchars($item['category']); ?></p>

<p><strong>Location:</strong> <?php echo htmlspecialchars($item['location']); ?></p>

<p><strong>Date:</strong> <?php echo htmlspecialchars($item['date']); ?></p>

<p><strong>Status:</strong> <?php echo htmlspecialchars($item['status']); ?></p>

<?php if(!empty($item['image'])): ?>
    <p><img src="../uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="Item Image" width="200"></p>
<?php endif; ?>


<p><a href="../dashboard.php">Back To Dashboard</a></p>
</div>
</body>
</html>