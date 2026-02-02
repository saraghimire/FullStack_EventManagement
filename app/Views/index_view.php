<h1>Dashboard</h1>
<input type="text" id="searchInput" placeholder="Search by title or category..." class="ajax-search">

<table>
    <thead>
        <tr>
            <th>Event Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="eventList">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $row): ?>
            <tr>
                <td><?= e($row['title']) ?></td>
                <td><?= e($row['category']) ?></td>
                <td><?= $row['event_date'] ?></td>
                <td>
                    <!-- Join is always visible to everyone -->
                    <a href="index.php?page=join&id=<?= $row['id'] ?>" class="act join">Join</a>
                    
                    <!-- ONLY SHOW EDIT/DELETE IF USER OWNS THE EVENT -->
                    <?php if (isset($_SESSION['user_id']) && $row['created_by'] == $_SESSION['user_id']): ?>
                        <span style="color: #ccc;">|</span>
                        <a href="index.php?page=edit&id=<?= $row['id'] ?>" class="act">Edit</a> 
                        
                        <span style="color: #ccc;">|</span>
                        <a href="index.php?page=delete&id=<?= $row['id'] ?>" class="act del" onclick="return confirm('Delete this event?')">Del</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align:center;">No events found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>