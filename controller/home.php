<?php

require_once("../includes/helper.php");

if (!isset($_SESSION['user'])) {

    header("Location: /?page=login");
    exit();
}

render("home", array('user' => $_SESSION['user']));
exit();





// END
