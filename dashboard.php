<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];

$sql = "SELECT * FROM items WHERE user_id='$user_id' ORDER BY date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lost & Found Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
    <a href="report_item.php">Report Lost/Found Item</a>
    <a href="item/search_items.php">Search Items</a>
    <a href="logout.php">Logout</a>

    <h2>Your Reported Items</h2>
    <?php if($result->num_rows > 0):?>
        <table border="1" cellpadding="5">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            <?php while($item = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                    <td><?php echo htmlspecialchars($item['status']); ?></td>
                    <td><?php echo htmlspecialchars($item['date']); ?></td>
                    <td>
                        <a href="items/view_item.php?id=<?php echo $item['id']; ?>">View</a> |
                        <a href="items/mark_resolved.php?id=<?php echo $item['id']; ?>">Mark Resolved</a> 
                    </td>   
                </tr>
                <?php endwhile;?>
        </table>
    <?php else: ?>
        <p>You have not reported any items yet.</p>
    <?php endif; ?>

</body>
</html>