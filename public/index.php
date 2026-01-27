<?php 
require_once '../config/db.php';
include '../includes/header.php'; 
?>

<h2>All Events</h2>

<!-- Live Search Input -->
<input type="text" id="searchInput" placeholder="Search by title or category..." style="width: 300px; padding: 10px;">

<div id="eventList">
    <!-- This table will be updated by Ajax, but we load it initially with PHP -->
    <table border="1" cellpadding="10">
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
        while ($row = $stmt->fetch()) {
            echo "<tr>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td>" . htmlspecialchars($row['category']) . "</td>
                <td>" . $row['event_date'] . "</td>
                <td>
                <a href='edit.php?id=".$row['id']."' class='btn-edit'>Edit</a> 
                <a href='delete.php?id=".$row['id']."' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                <a href='register.php?id=".$row['id']."' class='btn-register'>Register</a>
                </td>
                </tr>";
        }
        ?>
    </table>
</div>

<?php include '../includes/footer.php'; ?>