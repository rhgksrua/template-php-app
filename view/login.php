<?php

require_once('../includes/helper.php');

$header_values = array(
    'title' => 'LOGIN'
);

render('header', $header_values);
?>

<div class="content-container">

    <div class="heading">
        <h1>LOGIN</h1>
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

            <!-- PASSWORD -->
            password
            <input type='password' name='password'>
            <?php echo isset($errors['password']) ? $errors['password'] : '' ?>
            <br />

            <input type='submit' value='Log In'>
        </form>
    </div>

    <p><a href="/?page=register">REGISTER</a></p>



</div>

<?php

render('footer');


