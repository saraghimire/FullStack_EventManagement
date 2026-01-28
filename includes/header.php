<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<nav>
    <div class="nav-content">
        <strong>EventMaster</strong>
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="index.php">Dashboard</a> | 
                <a href="add.php">Add Event</a> | 
                <a href="logout.php" style="color:red">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a> | <a href="signup.php">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">