<?php

$error = '';



if (isset($_POST['username'], $_POST['password']) && 
    !empty($_POST['username']) &&
    !empty( $_POST['password'])) {

    require_once('Auth.php');
    $auth = new Auth();

    if ($auth->createUser($_POST['username'], $_POST['password']) == true) {
        header("Location: welcome.php");
    } else {
        echo "Could not add user";
    }




} else if (isset($_POST['username'], $_POST['password'])) {
    $error = "Invalid username or password";
}

?>

<form action='' method='post'>
    <input type='text' name='username'>
    <input type='password' name='password'>
    <input type='submit' value='create user'><span><?= $error ?></span>
</form>
