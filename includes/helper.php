<?php

// Helper functions

function render($template, $data = array())
{
    $path = __DIR__ . '/../view/' . $template . '.php';
	if (file_exists($path))
    {
        extract($data);
        require($path);
    }
}

function logged_in() {
    if (isset($_SESSION['user']) AND count($_SESSION['user']) == 4) {
        header("Location: /");
        exit();
    }
    return FALSE;
}
