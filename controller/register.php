<?php

require_once('../includes/helper.php');
require_once('../model/model.php');

$username = '';
$email = '';
$errors = array();


// Check user form submit
if (isset($_POST['username'],
          $_POST['password'],
          $_POST['verify'],
          $_POST['email'],
          $_POST['form_token'])
        ) {

    // Prevent resubmit and csrf
    if ($_POST['form_token'] != $_SESSION['form_token']) {
        echo "<p>Form error</p>";
        echo "<a href='/'>Register</a>";
        exit();
    }

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $verify = $_POST['verify'];

    // Check username
    if (empty($username)) {
        // Empty username
        $errors[] = "Please enter a username";
    } else if (strlen($username) < 6) {
        // Invalid username
        $errors[] = "Username must be at least 6 characters";
    } else if (preg_match('/^[a-z0-9][a-z0-9_-]{5,32}$/', $username) == 0) {
        $errors[] = "Invalid username";
    }

    // Check password
    if (empty($password)) {
        $errors[] = "Please enter a password";
    } else if (empty($verify)) {
        $errors[] = "Please verify your password";
    } else if ($password !== $verify) {
        $errors[] = "Passwords do not match";
    }

    // Check errors
    if (empty($errors)) {
        // No errors add to database
        $user_id = add_user($username, $email, $password); 
        if ($user_id != false) {
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: /?page=home");
            exit();
        } else {
            echo "failed to add";
            exit();
        }

        
    } else {
        // Error in form.  Display error.
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}


// Prevent CSRF and resubmit
$form_token = md5(rand(time(), true));
$_SESSION['form_token'] = $form_token;

// Remember user inputs (username, email) and send token
$template_values = array(
    'username' => $username,
    'email' => $email,
    'form_token' => $form_token
);

render('register', $template_values);

