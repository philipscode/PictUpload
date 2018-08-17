<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/17/18
 * Time: 9:02 PM
 */

namespace Specific\Entity;


class Picture
{
    public $id;
    public $name;
    public $date;
    public $userId;
    private $usersTable;
    private $user;

    public function __construct(\General\DatabaseTable $usersTable)
    {
        $this->usersTable = $usersTable;
    }

    public function getUser()
    {
        if (empty($this->user)) {
            $this->user = $this->usersTable->findById($this->userId);
        }

        return $this->user;
    }

}