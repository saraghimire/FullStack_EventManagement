<div class="card-container">
    <div class="form-card">
        <div class="card-header">
            <h2><?= e($title) ?></h2> 
            <p>Enter the details below to host a new event.</p>
        </div>

        <?php if(isset($error)): ?>
            <p style="color:red; margin-bottom:15px;"><?= e($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?page=create">
            <input type="hidden" name="csrf_token" value="<?= get_token() ?>">

            <div class="form-row">
                <div class="form-group">
                    <label>Event Title</label>
                    <input type="text" name="title" placeholder="e.g., Staff Meeting" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="event_date" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" placeholder="e.g., Education">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" placeholder="e.g., Conference Room B">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" placeholder="Briefly describe the event..."></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-save">Save Event</button>
                <a href="index.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>