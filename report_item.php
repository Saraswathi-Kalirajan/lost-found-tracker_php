<?php 
session_start();
include 'config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}



if(isset($_POST['submit'])){
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$image);

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO items (user_id, title, description, category, location, date, status, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssss", $user_id, $title, $description, $category, $location, $date, $status, $image);

if($stmt->execute()){
    echo "Item reported successfully!";
} else {
    echo "Error: " . $stmt->error;
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Resolved</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="report-card">
<form method="POST" action=""  enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Item-Title" required/>
   <textarea name="description" placeholder="Description" required></textarea>
    <select name="category">
        <option value = "ID Card">ID Card</option>
        <option value="Mobile">Mobile</option>
        <option value="Book">Book</option>
        <option value="Other">Other</option>
</select>
<input type="text" name="location" placeholder="Location" required />
    <input type="date" name="date" required />
    <select name="status">
        <option value="lost">Lost</option>
        <option value="found">Found</option>
    </select>
    <input type="file" name="image" required />
    <button type="submit" name="submit">Submit</button>
</form>

<div>
    <a href="dashboard.php" >Back To Dashboard</a>
</body>
</html>