<h2>Add New Event</h2>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">
    <input type="text" name="title" placeholder="Event Title" required><br>
    <input type="text" name="category" placeholder="Category"><br>
    <input type="date" name="event_date" required><br>
    <input type="text" name="location" placeholder="Location"><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <button type="submit" class="btn">Create Event</button>
</form>