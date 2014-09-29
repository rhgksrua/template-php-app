<?php

session_start();

if ($_GET['page'] == 'login') {

}

if (isset($_GET['page']) && $_GET['page'] == 'kill') {
    session_destroy();
    header("Location: /");
    exit();
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}


$path = '../controller/' . $page . '.php';
if (file_exists($path)) {
    require($path);
} else {
    // 404
    echo "404 Page Not Found";
}



?> 
