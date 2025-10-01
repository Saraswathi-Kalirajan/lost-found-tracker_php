<?php
include 'config/db.php';
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
     
    if($conn->query($sql) === TRUE ){
         $success = "Registration successful. <a href='login.php'>Login here</a>";
    }
    else{
        $error = "Error: ".$conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Lost & Found Tracker</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>

    <div class="register-card">
        <h1>Register</h1>

        <?php if(isset($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" name="register">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>    
</html>
