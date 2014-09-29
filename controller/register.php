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
        $errors['username'] = "Please enter a username";
    } else if (strlen($username) < 6) {
        // Invalid username
        $errors['username'] = "Username must be at least 6 characters";
    } else if (preg_match('/^[a-z0-9][a-z0-9_-]{5,32}$/', $username) == 0) {
        $errors['username'] = "Invalid username";
    } else if (check_username($username) == FALSE) {
        $errors['username'] = "Username exists";
    }

    // Check email
    if (empty($email)) {
        // Empty email
        $errors['email'] = "Please enter an email";
    } else if (check_email($email) == FALSE) {
        $errors['email'] = "Email exists";
    }

    // Check password
    if (empty($password)) {
        $errors['password'] = "Please enter a password";
    } else if (empty($verify)) {
        $errors['verify'] = "Please verify your password";
    } else if ($password !== $verify) {
        $errors['password'] = "Passwords do not match";
    }

    // Check errors
    if (empty($errors)) {
        // Check DB for existing username and email
        $user_id = add_user($username, $email, $password); 

        echo "user id: ";
        print_r($user_id);

        if ($user_id == FALSE) {
            echo "Failed to add user";
            exit();
        } else { 
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: /?page=home");
            exit();
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
    'form_token' => $form_token,
    'errors' => $errors
);

render('register', $template_values);

