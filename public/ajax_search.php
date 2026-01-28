<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
$q = "%" . ($_GET['q'] ?? '') . "%";
$stmt = $pdo->prepare("SELECT * FROM events WHERE title LIKE ? OR category LIKE ?");
$stmt->execute([$q, $q]);
$events = $stmt->fetchAll();

foreach ($events as $row) {
    echo "<tr>
        <td>".e($row['title'])."</td>
        <td>".e($row['category'])."</td>
        <td>".$row['event_date']."</td>
        <td>
            <a href='register.php?id=".$row['id']."'>Join</a> | 
            <a href='edit.php?id=".$row['id']."'>Edit</a> | 
            <a href='delete.php?id=".$row['id']."' onclick='return confirm(\"Delete?\")'>Del</a>
        </td>
    </tr>";
}