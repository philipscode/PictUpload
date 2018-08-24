<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/13/18
 * Time: 10:28 AM
 */


namespace Specific;
use \General\DatabaseTable;


class Routes
{
    private $picturesTable;
    private $usersTable;
    private $commentsTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__.'/../../includes/dbConnection.php';

        $this->picturesTable = new DatabaseTable($pdo, 'pictures', '\Specific\Entity\Picture', [&$this->usersTable]);
        $this->usersTable = new DatabaseTable($pdo, 'users', '\Specific\Entity\User', [&$this->picturesTable]);
        $this->commentsTable = new DatabaseTable($pdo, 'comments', '\Specific\Entity\Comment', [$this->usersTable]);
        $this->authentication = new \General\Authentication($this->usersTable, 'name', 'password');
    }

    public function getRoutes()
    {
        $picturesController = new \Specific\Controllers\PictController($this->picturesTable, $this->usersTable);
        $usersController = new \Specific\Controllers\UserController($this->usersTable);
        $loginController = new \Specific\Controllers\LoginController($this->authentication);
        $commentsController = new \Specific\Controllers\CommentController($this->commentsTable, $this->picturesTable, $this->usersTable);

        $routes = [
            '' => [
                'GET' => [
                    'controller' => $picturesController,
                    'action' => 'listPictures'
                ]
            ],
            'picture/add' => [
                'GET' => [
                    'controller' => $picturesController,
                    'action' => 'add'
                ],
                'POST' => [
                    'controller' => $picturesController,
                    'action' => 'save'
                ],
                'login' => true
            ],
            'picture/delete' => [
                'POST' => [
                    'controller' => $picturesController,
                    'action' => 'delete'
                ],
                'login' => true
            ],
            'user/register' => [
                'GET' => [
                    'controller' => $usersController,
                    'action' => 'registrationForm'
                ],
                'POST' => [
                    'controller' => $usersController,
                    'action' => 'registerUser'
                ]
            ],
            'login' => [
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin'
                ]
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginError'
                ]
            ],
            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
                ]
            ],
            'comments' => [
                'GET' => [
                    'controller' => $commentsController,
                    'action' => 'show'
                ]
            ],
            'comments/add' => [
                'POST' => [
                    'controller' => $commentsController,
                    'action' => 'add'
                ]
            ]
        ];

        return $routes;
    }

    public function getAuthentication()
    {
        return $this->authentication;
    }
}