<?php


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


$form_token = md5(rand(time(), true));
$_SESSION['form_token'] = $form_token;

?>
<form action='' method='post'>
    <input type='hidden' name='form_token' value='<?php echo $form_token; ?>'>
    username
    <input type='text' name='username' value='<?php echo !empty($username) ? $username : '' ?>'>
    <br />
    email
    <input type='text' name='email' value='<?php echo !empty($email) ? $email : '' ?>'>
    <br />
    password
    <input type='password' name='password'>
    <br />
    verify password
    <input type='password' name='verify'>
    <br />
    <input type='submit' value='Register'>
</form>
