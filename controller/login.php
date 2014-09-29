<?php

require_once('../includes/helper.php');
require_once('../model/model.php');

$username = '';
$errors = array();


if (isset($_POST['username'],
          $_POST['password'],
          $_POST['form_token'])
        ) {

    if ($_POST['form_token'] != $_SESSION['form_token']) {
        echo "<p>Form error</p>";
        echo "<a href='/'>Register</a>";
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        // Empty username
        $errors['username'] = "Please enter your username";
    }

    if (empty($password)) {
        $errors['password'] = "Please enter your password";
    }

    if (empty($errors)) {
        $user_id = get_user($username, $password);
        echo "getuser";
        print_r($user_id);
        if ($user_id != FALSE) {
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: /?page=home");
            exit();
        } else {
            $errors['username'] = "Username or password error";
        } 
    }
}


$form_token = md5(rand(time(), true));
$_SESSION['form_token'] = $form_token;


$login_values = array(
    'username' => $username,
    'form_token' => $form_token,
    'errors' => $errors
);

render('login', $login_values);

// END
