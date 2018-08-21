<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/20/18
 * Time: 4:49 PM
 */

namespace Specific\Controllers;


class LoginController
{
    private $authentication;

    public function __construct(\General\Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function processLogin()
    {
        if ($this->authentication->login($_POST['name'], $_POST['password'])) {
            header('location: /');
        } else {
            return [
                'title' => 'Login Error',
                'template' => 'loginError.html.php',
                'variables' => [
                    'error' => 'Invalid username/password'
                ]
            ];
        }
    }

    public function loginError()
    {
        return [
            'title' => 'Login Error',
            'template' => 'loginError.html.php',
            'variables' => [
                'error' => 'You must be logged in to view this page.'
            ]
        ];
    }

    public function logout()
    {
        unset($_SESSION);
        session_destroy();
        header('location: /');
    }
}