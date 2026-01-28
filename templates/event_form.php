<div class="card">
    <h2><?= $type ?> Event</h2>
    <form method="POST">
        <input type="hidden" name="csrf" value="<?= get_token() ?>">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="category" placeholder="Category">
        <input type="date" name="event_date" required>
        <input type="text" name="location" placeholder="Location">
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>