<?php

require('../../pw.php');

define('DB_NAME', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USER', $user);
define('DB_PASSWORD', $pw);
define('DB_DATABASE', 'baseballmanager');

function check_username($username) {


    $dsn = DB_NAME . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE;

    // Connect to DB
    try {
        $dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    } catch (Exception $e) {
        die("Unable to connect: " . $e->getMessage());
    }

    try {
        // Begin transaction
        $dbh->beginTransaction();

        // Check for existing username
        $stmt = $dbh->prepare("SELECT username FROM users WHERE username=:username");
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return FALSE;
        }
        return TRUE;

    } catch (Exception $e) {
        echo $e->getMessage();
        // Failed to add user
        $dbh->rollBack();
        $dbh = null;

        return FALSE;
    }
}

function check_email($email) {

    $dsn = DB_NAME . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE;

    // Connect to DB
    try {
        $dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    } catch (Exception $e) {
        die("Unable to connect: " . $e->getMessage());
    }

    try {
        // Begin transaction
        $dbh->beginTransaction();

        // Check for existing username
        $stmt = $dbh->prepare("SELECT email FROM users WHERE email=:email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return FALSE;
        }
        return TRUE;

    } catch (Exception $e) {
        echo $e->getMessage();
        // Failed to add user
        $dbh->rollBack();
        $dbh = null;

        return FALSE;
    }
}

// returns user id on sucess
//         false on fail
function add_user($username, $email, $password, $role = 1) {

    $dsn = DB_NAME . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE;

    // Connect to DB
    try {
        $dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    } catch (Exception $e) {
        die("Unable to connect: " . $e->getMessage());
    }

    // Insert user to DB
    try {
        // Begin transaction
        $dbh->beginTransaction();

        // Add user info to DB
        $stmt = $dbh->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':role', $role, PDO::PARAM_INT);
        $stmt->execute();

        // Get id of user
        $id = $dbh->lastInsertId();
        print_r($id);

        // End transaction
        $dbh->commit();
        $dbh = null;

        return $id;
    } catch (Exception $e) {
        echo $e->getMessage();
        // Failed to add user
        $dbh->rollBack();
        $dbh = null;

        return FALSE;
    }
}


function get_user($username, $password) {

    require('../../pw.php');

    define('DB_NAME', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_USER', $user);
    define('DB_PASSWORD', $pw);
    define('DB_DATABASE', 'baseballmanager');

    $dsn = DB_NAME . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE;

    // Connect to DB
    try {
        $dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    } catch (Exception $e) {
        die("Unable to connect: " . $e->getMessage());
    }

    // Insert user to DB
    try {
        // Begin transaction
        $dbh->beginTransaction();
        $stmt = $dbh->prepare("SELECT id FROM users WHERE username=:username AND password=:password");
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($result) == 1) {
            return $result['id'];
        } else {
            return FALSE;
        }

        // End transaction
        $dbh->commit();
        $dbh = null;

        return $id;
    } catch (Exception $e) {
        // Failed to add user
        $dbh->rollBack();
        $dbh = null;

        return false;
    }

}
