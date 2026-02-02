<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

// Since this is a standalone file, we must manually start session to check protection
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
protect_page();

// 1. Connect using the new Class method
$pdo = Database::connect();

$q = "%" . ($_GET['q'] ?? '') . "%";

// 2. Perform Search
$stmt = $pdo->prepare("SELECT * FROM events WHERE title LIKE ? OR category LIKE ?");
$stmt->execute([$q, $q]);
$results = $stmt->fetchAll();

// 3. Output HTML Rows with UPDATED LINKS
foreach ($results as $row) {
    echo "<tr>
            <td>".e($row['title'])."</td>
            <td>".e($row['category'])."</td>
            <td>".$row['event_date']."</td>
            <td>
                <a href='index.php?page=join&id=".$row['id']."' class='act join'>Join</a> | 
                <a href='index.php?page=edit&id=".$row['id']."' class='act'>Edit</a> | 
                <a href='index.php?page=delete&id=".$row['id']."' class='act del' onclick='return confirm(\"Delete?\")'>Del</a>
            </td>
          </tr>";
}
?>