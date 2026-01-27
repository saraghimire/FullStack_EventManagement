<?php 
require_once '../config/db.php';
require_once '../includes/functions.php';
include '../includes/header.php'; 
?>

<h2>Event Dashboard</h2>

<!-- Advanced Live Search Input -->
<div style="margin-bottom: 20px;">
    <input type="text" id="searchInput" placeholder="Search by title, category, or location..." autocomplete="off">
    <small>Results update automatically as you type (Ajax)</small>
</div>


<div id="eventList">
    <!-- This table will be updated by Ajax, but we load it initially with PHP -->
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
            while ($row = $stmt->fetch()) : ?>
                <tr>
                    <td><?= e($row['title']) ?></td>
                    <td><?= e($row['category']) ?></td>
                    <td><?= $row['event_date'] ?></td>
                    <td><?= e($row['location']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a> |
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a> |
                        <a href="register.php?id=<?= $row['id'] ?>" style="color:green">Join</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>