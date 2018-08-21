<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/19/18
 * Time: 5:54 PM
 */

namespace Specific\Controllers;


class UserController
{
    private $usersTable;

    public function __construct(\General\DatabaseTable $usersTable)
    {
        $this->usersTable = $usersTable;
    }

    public function registrationForm()
    {
        return [
            'title' => 'Create an Account',
            'template' => 'registrationForm.html.php'
        ];
    }

    public function registerUser()
    {
        $user = $_POST['author'];

        $valid = true;
        $errors = [];

        $user['email'] = strtolower($user['email']);

        if (count($this->usersTable->find('email', $user['email'])) > 0) {
            $valid = false;
            $errors[] = 'User with such an email address is already registered.';
        }

        if ($valid) {
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

            $this->usersTable->save($user);

            header('location: /');

        } else {
            return [
                'template' => 'registrationForm.html.php',
                'title' => 'Create an Account',
                'variables' => [
                    'errors' => $errors,
                    'user' => $user
                ]
            ];
        }
    }
}