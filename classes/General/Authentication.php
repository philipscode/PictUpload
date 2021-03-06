<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/20/18
 * Time: 4:51 PM
 */

namespace General;


class Authentication
{
    private $users;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct(\General\DatabaseTable $users, $usernameColumn, $passwordColumn)
    {
        session_start();
        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
    }

    public function login($username, $password)
    {
        $user = $this->users->find($this->usernameColumn, strtolower($username));

        if (!empty($user) && password_verify($password, $user[0]->{$this->passwordColumn})) {
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0]->{$this->passwordColumn};
            $_SESSION['id'] = $user[0]->id;
            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn()
    {
        if (empty($_SESSION['username'])) {
            return false;
        }

        $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));

        if (!empty($user) && $user[0]->{$this->passwordColumn} === $_SESSION['password']) {
            return true;
        } else {
            return false;
        }
    }
}