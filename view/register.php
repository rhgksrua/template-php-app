<?php

require_once('../includes/helper.php');

$template_values = array(
    'title' => 'REGISTER'
);

render('header', $template_values);

?>

<div class="heading">
    <h1>REGISTER</h1>
</div>

<div class="form-container">
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
</div>

<?php

render('footer');


