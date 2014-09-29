<?php

require_once('../includes/helper.php');

$header_values = array(
    'title' => 'REGISTER'
);

render('header', $header_values);
?>

<div class="heading">
    <h1>REGISTER</h1>
</div>

<div class="form-container">
    <form action='' method='post'>
        <!-- token -->
        <input type='hidden' name='form_token' value='<?php echo $form_token; ?>'>

        <!-- USERNAME -->
        username
        <input type='text' name='username' value='<?php echo !empty($username) ? $username : '' ?>'>
        <?php echo isset($errors['username']) ? $errors['username'] : '' ?>
        <br />

        <!-- EMAIL -->
        email
        <input type='text' name='email' value='<?php echo !empty($email) ? $email : '' ?>'>
        <?php echo isset($errors['email']) ? $errors['email'] : '' ?>
        <br />

        <!-- PASSWORD -->
        password
        <input type='password' name='password'>
        <?php echo isset($errors['password']) ? $errors['password'] : '' ?>
        <br />

        <!-- VERIFY PASSWORD -->
        verify password
        <input type='password' name='verify'>
        <?php echo isset($errors['verify']) ? $errors['verify'] : '' ?>
        <br />

        <input type='submit' value='Register'>
    </form>
</div>

<p><a href="/?page=login">LOGIN</a></p>

<?php

render('footer');


