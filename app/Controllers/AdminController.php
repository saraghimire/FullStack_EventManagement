<?php
require_once '../app/Models/EventModel.php';
require_once '../app/Models/UserModel.php';

class AdminController {
    private $pdo;
    private $eventModel;
    private $userModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->eventModel = new EventModel($pdo);
        $this->userModel = new UserModel($pdo);
    }

    // This is the "Admin Panel"
    public function dashboard() {
        protect_admin(); 
        $allEvents = $this->eventModel->get_all_events();
        $allUsers = $this->userModel->get_all_users();
        
        $stats = [
            'total_events' => count($allEvents),
            'total_users'  => count($allUsers),
        ];

        $this->render('admin_view', ['events' => $allEvents, 'stats' => $stats]);
    }

    // This is the "Manage Users" page
    public function manageUsers() {
        protect_admin();
        
        // Handle User Actions
        $action = $_GET['action'] ?? null;
        $id = $_GET['id'] ?? null;

        if ($action && $id) {
            if ($action === 'change_role') {
                $newRole = $_GET['role'];
                $this->userModel->update_user_role($id, $newRole);
                header("Location: index.php?page=admin_users&msg=updated");
                exit;
            }
            if ($action === 'delete_user' && $id != $_SESSION['user_id']) {
                $this->userModel->delete_user($id);
                header("Location: index.php?page=admin_users&msg=deleted");
                exit;
            }
        }

        $users = $this->userModel->get_all_users();
        $this->render('admin_users_view', ['users' => $users]);
    }

    private function render($view, $data = []) {
        extract($data);
        require '../app/Views/layout/header.php';
        require "../app/Views/$view.php";
        require '../app/Views/layout/footer.php';
    }
}