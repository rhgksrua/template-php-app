<?php

require_once('../includes/helper.php');

setcookie(session_name(), "", time() - 3600);
session_destroy();

render("logout");


