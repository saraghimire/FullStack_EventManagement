<h1>Admin Panel: Global Overview</h1>

<div class="stats-grid" style="display: flex; gap: 20px; margin-bottom: 30px;">
    <div class="card-container" style="flex: 1; text-align:center;">
        <h3>Total Events</h3>
        <p style="font-size: 2rem; font-weight: bold; color: var(--brand);"><?= $stats['total_events'] ?></p>
    </div>
</div>

<h3>All System Events</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Creator ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $row): ?>
        <tr>
            <td>#<?= $row['id'] ?></td>
            <td><?= e($row['title']) ?></td>
            <td>User <?= $row['created_by'] ?></td>
            <td>
                <!-- Admin can edit/delete EVERYTHING -->
                <a href="index.php?page=edit&id=<?= $row['id'] ?>" class="act">Manage</a> |
                <a href="index.php?page=delete&id=<?= $row['id'] ?>" class="act del">Global Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>