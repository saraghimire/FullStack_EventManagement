<div class="card">
    <h2><?= $type ?></h2>
    <?php if($error): ?><p style="color:red"><?= e($error) ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn"><?= $type ?></button>
    </form>
</div>