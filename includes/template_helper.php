<?php
function render($template, $data = []) {
    extract($data);
    ob_start();
    include "../templates/" . $template . ".php";
    return ob_get_clean();
}