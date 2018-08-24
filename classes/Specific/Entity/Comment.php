<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/24/18
 * Time: 12:23 PM
 */

namespace Specific\Entity;


class Comment
{
    public $id;
    public $userId;
    public $pictureId;
    public $date;
    public $text;
    private $usersTable;

    public function __construct(\General\DatabaseTable $usersTable)
    {
        $this->usersTable = $usersTable;
    }

    public function getUser()
    {
        $user = $this->usersTable->findById($this->userId);

        return $user;
    }
}