<?php
require_once '../app/Models/EventModel.php';

class EventController {
    private $model;

    public function __construct($pdo) {
        $this->model = new EventModel($pdo);
    }

    // Dashboard
    public function index() {
        protect_page();
        $events = $this->model->get_all_events();
        $this->render('index_view', ['events' => $events]);
    }

    // Add Event
    public function create() {
        protect_page();
        $error = null;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!verify_token($_POST['csrf_token'])) die("CSRF Failed");
            
            // Pass User ID for ownership
            if ($this->model->create_event($_POST, $_SESSION['user_id'])) {
                header("Location: index.php");
                exit;
            } else {
                $error = "Failed to create event.";
            }
        }
        $this->render('event_form_view', ['title' => 'Create Event', 'error' => $error]);
    }

    // Delete Event
    public function delete() {
        protect_page();
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            // SECURITY CHECK: Get the event first
            $event = $this->model->get_event_by_id($id);

            // If current user is NOT the creator, stop them.
            if ($event['created_by'] != $_SESSION['user_id'] && $_SESSION['role'] !== 'admin') {
                die("ACCESS DENIED: You do not own this event.");
            }
                
            $this->model->delete_event($id);
        }
        header("Location: index.php");
        exit;
    }
    
    // Edit Event
    public function edit() {
        protect_page();
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: index.php"); exit; }
        
        // SECURITY CHECK
        $event = $this->model->get_event_by_id($id);
    
        if ($event['created_by'] != $_SESSION['user_id'] && $_SESSION['role'] !== 'admin') {
            die("ACCESS DENIED: You do not own this event.");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!verify_token($_POST['csrf_token'])) die("CSRF Failed");
            
            $this->model->update_event($_POST, $id);
            header("Location: index.php?msg=updated");
            exit;
        }
        
        $this->render('edit_view', ['event' => $event, 'id' => $id]);
    }
    
    // Register (Join) Event - UPDATED FOR FLASH MESSAGES
    public function join() {
        protect_page();
        $event_id = $_GET['id'] ?? null;
        $user_id = $_SESSION['user_id'];
        
        if ($event_id) {
            $isSuccess = $this->model->register_user($event_id, $user_id);
            
            if ($isSuccess) {
                // SUCCESS: Set session message
                $_SESSION['flash_message'] = "Joined successfully!";
                $_SESSION['flash_type'] = "success"; // Green style
            } else {
                // ERROR: Set session message
                $_SESSION['flash_message'] = "You have already joined this event.";
                $_SESSION['flash_type'] = "error"; // Red style
            }
            
            // Redirect IMMEDIATELY (No JavaScript Pop-up)
            header("Location: index.php?page=my_events");
            exit;
            
        } else {
            header("Location: index.php");
            exit;
        }
    }
    
    // Show User's Bookings
    public function myEvents() {
        protect_page();
        $user_id = $_SESSION['user_id'];
        
        // Get data from Model
        $myEvents = $this->model->get_events_by_user($user_id);
        // Load View
        $this->render('my_events_view', ['events' => $myEvents]);
    }

    // Helper to load views with Header/Footer
    private function render($view, $data = []) {
        extract($data);
        require '../app/Views/layout/header.php';
        require "../app/Views/$view.php";
        require '../app/Views/layout/footer.php';
    }
}
?>