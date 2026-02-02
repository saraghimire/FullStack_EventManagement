<?php
// 1. Load Configurations and Helpers
require_once '../config/db.php';
require_once '../includes/functions.php';

// 2. Connect to Database (Using your new Class)
$pdo = Database::connect();

// 3. Load Controllers
require_once '../app/Controllers/AuthController.php';
require_once '../app/Controllers/EventController.php';
require_once '../app/Controllers/AdminController.php';

// 4. Instantiate Controllers
$authController = new AuthController($pdo);
$eventController = new EventController($pdo);
$adminController = new AdminController($pdo);

// 5. Determine which page to show (The Router)
$page = $_GET['page'] ?? 'home';

switch ($page) {
    // --- AUTHENTICATION ROUTES ---
    case 'login':
        $authController->login();
        break;
        
    case 'signup':
        $authController->signup();
        break;
        
    case 'logout':
        $authController->logout();
        break;

    // --- ADMIN ROUTES ---
    case 'admin':
        $adminController->dashboard();
        break;

    case 'admin_users':
        $adminController->manageUsers();
        break;

    // --- EVENT ROUTES ---
    case 'create':
        $eventController->create(); // Was add.php
        break;
        
    case 'edit':
        $eventController->edit();   // Was edit.php
        break;
        
    case 'delete':
        $eventController->delete(); // Was delete.php
        break;
        
    case 'join':
        $eventController->join();   // Was register.php
        break;

    case 'my_events':
        $eventController->myEvents();
        break;

    // --- DASHBOARD (Default) ---
    case 'home':
    default:
        // If user is not logged in, redirect them to login page
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }
        $eventController->index();  // Was index.php
        break;
}
?>