<div class="card-container">
    <div class="form-card">
        <div class="card-header">
            <h2>Edit Event Details</h2>
            <p>Modify the information below to update your event.</p>
        </div>

        <form method="POST"  action="index.php?page=edit&id=<?= $id ?>">
            <!-- Security: CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= get_token() ?>">

            <div class="form-row">
                <div class="form-group">
                    <label>Event Title</label>
                    <input type="text" name="title" value="<?= e($event['title']) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="event_date" value="<?= $event['event_date'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" value="<?= e($event['category']) ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="<?= e($event['location']) ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="5"><?= e($event['description']) ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-save">Save Changes</button>
                <a href="index.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>