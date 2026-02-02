<!-- FLASH MESSAGE LOGIC -->
<?php if(isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-<?= $_SESSION['flash_type'] ?>">
        <?= $_SESSION['flash_message'] ?>
    </div>
    <?php 
        
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
    ?>
<?php endif; ?>

<h1>My Bookings</h1>
<p>Here are the events you are registered for.</p>

<div class="card-container">
    <table>
        <thead>
            <tr>
                <th>Event Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $row): ?>
                <tr>
                    <td><?= e($row['title']) ?></td>
                    <td><?= $row['event_date'] ?></td>
                    <td><?= e($row['location']) ?></td>
                    <td>
                        <span style="color: green; font-weight: bold;">✔ Registered</span>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">
                        You haven't joined any events yet. 
                        <a href="index.php?page=home">Browse Events</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        <a href="index.php?page=home" class="btn btn-cancel">Back to Dashboard</a>
    </div>
</div>