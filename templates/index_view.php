<h1>Dashboard</h1>
<input type="text" id="searchInput" placeholder="Search by title or category..." class="ajax-search">

<table>
    <thead>
        <tr><th>Event Title</th><th>Category</th><th>Date</th><th>Actions</th></tr>
    </thead>
    <tbody id="eventList">
        <?php foreach ($events as $row): ?>
        <tr>
            <td><?= e($row['title']) ?></td>
            <td><?= e($row['category']) ?></td>
            <td><?= $row['event_date'] ?></td>
            <td>
                <a href="register.php?id=<?= $row['id'] ?>" class="act join">Join</a> | 
                <a href="edit.php?id=<?= $row['id'] ?>" class="act">Edit</a> | 
                <a href="delete.php?id=<?= $row['id'] ?>" class="act del" onclick="return confirm('Delete?')">Del</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>