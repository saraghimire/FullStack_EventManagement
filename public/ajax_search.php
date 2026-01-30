<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
protect_page();

$q = "%" . ($_GET['q'] ?? '') . "%";
$stmt = $pdo->prepare("SELECT * FROM events WHERE title LIKE ? OR category LIKE ?");
$stmt->execute([$q, $q]);
$results = $stmt->fetchAll();

foreach ($results as $row) {
    echo "<tr>
            <td>".e($row['title'])."</td>
            <td>".e($row['category'])."</td>
            <td>".$row['event_date']."</td>
            <td>
                <a href='register.php?id=".$row['id']."' class='act join'>Join</a> | 
                <a href='edit.php?id=".$row['id']."' class='act'>Edit</a> | 
                <a href='delete.php?id=".$row['id']."' class='act del' onclick='return confirm(\"Delete?\")'>Del</a>
            </td>
          </tr>";
}