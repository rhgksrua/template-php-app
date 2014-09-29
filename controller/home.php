<?php

require_once("../includes/helper.php");

if (!isset($_SESSION['user'])) {

    header("Location: /?page=register");
    exit();
}


render("home", array('user' => $_SESSION['user']));
exit();





// END
