<?php

require_once("../includes/helper.php");

$header_values = array(
    'title' => 'HOME'
);

render('header', $header_values);

?>

<p><?php echo "ID: {$user['id']}" ?></p>
<p><?php echo "USERNAME: {$user['username']}" ?></p>
<p><?php echo "EMAIL: {$user['email']}" ?></p>
<p><?php echo "ROLE: {$user['role']}" ?></p>

<p><a href="/?page=kill">KILL</a></p>

<?php

render('footer');

// END
