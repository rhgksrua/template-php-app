<?php

$errors = array();

if (isset($_POST['username'],
          $_POST['password'],
          $_POST['verify'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $verify = $_POST['verify'];

    // Check username
    if (empty($username)) {
        $errors[] = "Please enter a username";
    } else if ($username == false) {
        // invalid username
        $errors[] = "Invalid username";
    }

    // Check password
    if (empty($password)) {
        $errors[] = "Please enter a password";
    } else if (empty($verify)) {
        $errors[] = "Please verify your password";
    } else if ($password !== $verify) {
        $errors[] = "Passwords do not match";
    } else {

    }

    // Check erros
    if (empty($errors)) {
        // No errors add to database
        echo "<p>$username</p>";
        echo "<p>$password</p>";
    } else {
        // Error in form.  Display error.
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}



?>
<form action='' method='post'>
    username
    <input type='text' name='username'>
    <br />
    password
    <input type='password' name='password'>
    <br />
    verify password
    <input type='password' name='verify'>
    <br />
    <input type='submit' value='Register'>
</form>
