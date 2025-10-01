<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$search = "";
$results = null;


if(isset($_POST['submit_search'])){
    $search = trim($_POST['query']); 
    if($search != ""){
     
        $sql = "SELECT * FROM items 
                WHERE title LIKE '%$search%' 
                ORDER BY date DESC";
        $results = $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Items</title>
    <link rel="stylesheet" href="../css/style.css"> 
</head>
<body>
    <h1>Search Items</h1>

    <form method="POST" action="">
        <input type="text" name="query" placeholder="Search by title" 
               value="<?php echo htmlspecialchars($search); ?>" required>
        <button type="submit" name="submit_search">Search</button>
    </form>

    <?php if($results && $results->num_rows > 0): ?>
        <h2>Results</h2>
        <table border="1" cellpadding="5">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            <?php while($item = $results->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['title']); ?></td>
                <td><?php echo htmlspecialchars($item['category']); ?></td>
                <td><?php echo htmlspecialchars($item['status']); ?></td>
                <td><?php echo htmlspecialchars($item['date']); ?></td>
                <td>
                    <a href="../items/view_item.php?id=<?php echo $item['id']; ?>">View</a> | 
                    <a href="../items/mark_resolved.php?id=<?php echo $item['id']; ?>">Mark Resolved</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php elseif($search != ""): ?>
        <p>No items found for your search.</p>
    <?php endif; ?>

    <p><a href="../dashboard.php">Back to Dashboard</a></p>
</body>
</html>
