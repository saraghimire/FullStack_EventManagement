<h1>User Management</h1>

<?php if (isset($_GET['msg'])): ?>
    <p style="color: green; margin-bottom: 10px;">Action successful: User list updated.</p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Current Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= e($user['username']) ?></td>
            <td><span class="badge"><?= strtoupper($user['role']) ?></span></td>
            <td>
                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                    <!-- Role Toggle -->
                    <?php if ($user['role'] === 'user'): ?>
                        <a href="index.php?page=admin_users&action=change_role&role=admin&id=<?= $user['id'] ?>" class="act">Make Admin</a>
                    <?php else: ?>
                        <a href="index.php?page=admin_users&action=change_role&role=user&id=<?= $user['id'] ?>" class="act">Make User</a>
                    <?php endif; ?>
                    
                    | 
                    
                    <!-- Delete -->
                    <a href="index.php?page=admin_users&action=delete_user&id=<?= $user['id'] ?>" 
                       class="act del" onclick="return confirm('Delete this user?')">Delete</a>
                <?php else: ?>
                    <span style="color: gray; font-style: italic;">(You)</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>