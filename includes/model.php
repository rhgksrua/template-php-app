<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'hankoh');
define('DB_PASSWORD', '7u5sfmYW');
define('DB_DATABASE', 'baseballmanager');

function model_add_user($email, $password, $user_salt, $verification_code, $is_admin) {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);

    // Begin transaction
    $dbh->beginTransaction();

    
    $stmt = $dbh->prepare("INSERT INTO users (email, password, user_salt, verification_code, is_admin) VALUES (:email, :password, :user_salt, :verification_code, :is_admin)");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':user_salt', $user_salt, PDO::PARAM_STR);
    $stmt->bindValue(':verification_code', $verification_code, PDO::PARAM_STR);
    $stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
    if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
            // Successfully added user to database
            $dbh->commit();
            $dbh = null;
            return true;
        }
    }
    $dbh->rollBack();
    $dbh = null;
    return False;

}

function select_user($email, $password) {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);

    // Begin transaction
    $dbh->beginTransaction();

    
    $stmt = $dbh->prepare("INSERT INTO users (email, password, user_salt, verification_code, is_admin) VALUES (:email, :password, :user_salt, :verification_code, :is_admin)");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':user_salt', $user_salt, PDO::PARAM_STR);
    $stmt->bindValue(':verification_code', $verification_code, PDO::PARAM_STR);
    $stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
    if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
            // Successfully added user to database
            $dbh->commit();
            $dbh = null;
            return true;
        }
    }
    $dbh->rollBack();
    $dbh = null;
    return False;

}
