<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/13/18
 * Time: 10:28 AM
 */

namespace Specific;

class Routes
{
    private $picturesTable;
    private $usersTable;

    public function __construct()
    {
        include __DIR__.'/../../includes/dbConnection.php';

        $this->picturesTable = new \General\DatabaseTable($pdo, 'pictures', '\Specific\Entity\Picture', [&$this->usersTable]);
        $this->usersTable = new \General\DatabaseTable($pdo, 'users', '\Specific\Entity\User', [&$this->picturesTable]);
    }

    public function getRoutes()
    {
        $picturesController = new \Specific\Controllers\PictController($this->picturesTable);

        $routes = [
            '' => [
                'GET' => [
                    'controller' => $picturesController,
                    'action' => 'listPictures'
                ]
            ]
        ];

        return $routes;
    }
}