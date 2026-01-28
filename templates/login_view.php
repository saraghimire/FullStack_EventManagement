<div class="auth-box">
    <h2>Login</h2>
    <?php if($error): ?><p style="color:red"><?= e($error) ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" class="btn">Login</button>
    </form>
</div>