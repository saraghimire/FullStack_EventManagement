<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Embassy Event Master</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <div class="logo">EMBASSY EVENTS</div>
    <div class="user-info">
        <?php if(isset($_SESSION['username'])) echo "Welcome, " . e($_SESSION['username']); ?>
    </div>
</header>
<div class="main-container">
    <aside class="sidebar">
    <nav>
        <?php if(isset($_SESSION['user_id'])): ?>
            <!-- Only visible when LOGGED IN -->
            <a href="index.php">Dashboard</a>
            <a href="add.php">Create Event</a>
            <a href="logout.php" style="color:red;">Logout</a>
        <?php else: ?>
            <!-- Only visible when LOGGED OUT -->
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        <?php endif; ?>
    </nav>
</aside>
    <main class="content">