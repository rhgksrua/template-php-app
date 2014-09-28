<?php

if (!isset($_SESSION['id'], $_SESSION['username'])) {

    header("Location: /?page=register");
    exit();
}

?>

<p>ID: <?= $_SESSION['id'] ?>, WELCOME <?= $_SESSION['username'] ?></p>


