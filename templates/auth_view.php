<div class="embassy-card">
    <h2><?= e($type) ?></h2> <!-- Uses $type passed from the render function -->
    
    <?php if($error): ?>
        <p style="color:red; margin-bottom: 15px;"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <!-- Security: CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?= get_token() ?>">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn btn-primary"><?= e($type) ?></button>
    </form>
    
    <p style="margin-top: 15px;">
        <?php if($type === 'Login'): ?>
            New user? <a href="signup.php">Create an account here</a>.
        <?php else: ?>
            Already have an account? <a href="login.php">Login here</a>.
        <?php endif; ?>
    </p>
</div>