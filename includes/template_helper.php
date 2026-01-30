<?php
function render($templateName, $data = []) {
    // This turns the ['error' => $error] array into a real $error variable
    extract($data); 

    $template_dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;

    if (substr($templateName, -4) !== '.php') {
        $templateName .= '.php';
    }

    $full_path = $template_dir . $templateName;

    if (file_exists($full_path)) {
        include $full_path;
    } else {
        echo "<div style='color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; margin: 10px; border-radius: 4px;'>";
        echo "<strong>Render Error:</strong> File <code>" . htmlspecialchars($templateName) . "</code> not found.";
        echo "</div>";
    }
}