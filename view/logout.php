<?php

$header_values = array(
    'title' => 'LOGOUT'
);

render('header', $header_values);

?>

<p>You have been logged out</p>
<p><a href="/?page=register">REGISTER</a></p>
<p><a href="/?page=login">LOGIN</a></p>

<?php

render('footer');

// END
