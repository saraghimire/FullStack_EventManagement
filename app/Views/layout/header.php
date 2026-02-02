<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Master</title>
    <!-- Modern Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<header>
    <div class="logo">EVENT MASTER</div>
    <div class="user-info">
        <?php if(isset($_SESSION['username'])) echo "Welcome, " . e($_SESSION['username']); ?>
    </div>
</header>

<div class="main-container">
    <aside class="sidebar">
        <nav>
            <?php if(isset($_SESSION['user_id'])): ?>
                <!-- --- LOGGED IN NAVIGATION --- -->
                
                <a href="index.php?page=home">Dashboard</a>
                
                <!-- Accessible to everyone logged in -->
                <a href="index.php?page=my_events">My Bookings</a>
                
                <!-- Only visible to Admins -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="index.php?page=admin" style="color: #fbbf24; font-weight: bold;">🛡️ Admin Panel</a>
                    <a href="index.php?page=admin_users">👥 Manage Users</a>
                <?php endif; ?>

               
                <a href="index.php?page=create">Create Event</a>
                
                <a href="index.php?page=logout" style="color:#f87171; margin-top: 20px;">Logout</a>

            <?php else: ?>
                <!-- --- LOGGED OUT NAVIGATION --- -->
                <a href="index.php?page=login">Login</a>
                <a href="index.php?page=signup">Sign Up</a>
            <?php endif; ?>
        </nav>
    </aside>

    <main class="content">