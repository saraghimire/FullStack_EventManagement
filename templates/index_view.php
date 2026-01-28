<h2>Dashboard</h2>
<input type="text" id="searchInput" placeholder="Live search events..." class="full-width">
<table>
    <thead><tr><th>Title</th><th>Category</th><th>Date</th><th>Actions</th></tr></thead>
    <tbody id="eventList">
        <?php foreach($events as $row): ?>
        <tr>
            <td><?= e($row['title']) ?></td>
            <td><?= e($row['category']) ?></td>
            <td><?= $row['event_date'] ?></td>
            <td>
                <a href="register.php?id=<?= $row['id'] ?>" style="color:green">Join</a> | 
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Del</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>