<?php

require_once('model.php');

class Auth {
    private $_siteKey;

    public function __construct() {
        $this->siteKey = '';
    }

    private function randomString($length = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxys';
        $string = '';
        for ($p = 0; $p < $length; $p++) {
            $c = $characters[mt_rand(0, strlen($characters) - 1)];
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];

        }

        return $string;
    }

    protected function hashData($data) {
        return hash_hmac('sha512', $data, $this->_siteKey);
    }

    public function isAdmin() {
        if ($selection[0]['is_admin'] == 1) {
            return true;
        }
        return false;
    }

    /*
     *
     *
     *
     *
     */
    public function createUser($email, $password, $is_admin = 0) {
        
        $user_salt = $this->randomString();
        $password = $user_salt . $password;
        $password = $this->hashData($password);
        $verification_code = $this->randomString();

        // Commit to database
        $created = model_add_user($email, $password, $user_salt, $verification_code, $is_admin);


        if ($created != false) {
            return true;
        }

        return false;
    }


    public function login($email, $password) {

        // Select user row from database
        $selection = select_user($email, $password);

        $password = $selection[0]['user_salt'] . $password;
        $password = $this->hashData($password);

        // Check email and password hash match database row
        $match = '';

        $is_active = (boolean) $selection['is_active'];
        $verified = (boolean) $selection['verified'];

        if ($match == true) {
            if ($is_active == true) {
                $random = $this->randomString();
                $token = $_SERVER['HTTP_USER_AGENT'] . $random;
                $token = $this->hashData($token);

                session_start();
                $_SESSION['token'] = $token;
                $_SESSION['user_id'] = $selection[0]['id'];

                $inserted = "";

                if ($inserted != false) {
                    return 0;
                }

                return 3;
            } else {
                return 1;
            }
        } else {
            return 2;
        }

        return 4;
    }



    public function checkSession() {

        if ($selection) {

            if (session_id() == $selection['session_id'] &&
                $_SESSION['token'] == $selection['token']) {

                $this->refreshSession();
                return true;
            }
        }
        return false;
    }

    private function refreshSession() {
        session_regenerate_id();

        $random = $this->randomString();

        $token = $_SERVER['HTTP_USER_AGENT'] . $random;
        $token = $this->hashData($token);

        $_SESSION['token'] = $token;
    }


    



        


}

        
