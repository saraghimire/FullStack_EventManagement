<?php
class EventModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function get_all_events() {
        $stmt = $this->pdo->query("SELECT * FROM events ORDER BY event_date ASC");
        return $stmt->fetchAll();
    }

    public function search_events($query) {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE title LIKE ? OR category LIKE ?");
        $term = "%$query%";
        $stmt->execute([$term, $term]);
        return $stmt->fetchAll();
    }

    public function create_event($data, $user_id) {
        // 2. Add 'created_by' to the SQL query
        $stmt = $this->pdo->prepare("INSERT INTO events (title, category, event_date, location, description, created_by) VALUES (?, ?, ?, ?, ?, ?)");
        
        return $stmt->execute([
            $data['title'], 
            $data['category'], 
            $data['event_date'], 
            $data['location'], 
            $data['description'],
            $user_id // 3. Save the ID
    ]);
}


    public function get_event_by_id($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update_event($data, $id) {
        $sql = "UPDATE events SET title=?, description=?, event_date=?, category=?, location=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['title'], 
            $data['description'], 
            $data['event_date'], 
            $data['category'], 
            $data['location'], 
            $id
        ]);
    }

    public function delete_event($id) {
        $stmt = $this->pdo->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function register_user($event_id, $user_id) {
        // Check if already registered to avoid errors
        $check = $this->pdo->prepare("SELECT id FROM registrations WHERE event_id = ? AND user_id = ?");
        $check->execute([$event_id, $user_id]);
        if($check->fetch()) return false;

        $stmt = $this->pdo->prepare("INSERT INTO registrations (event_id, user_id) VALUES (?, ?)");
        return $stmt->execute([$event_id, $user_id]);
    }
    
    public function get_events_by_user($user_id) {
        // JOIN query to get event details for a specific user
        $sql = "SELECT events.* FROM events 
        JOIN registrations ON events.id = registrations.event_id 
        WHERE registrations.user_id = ?
        ORDER BY events.event_date ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
}
}