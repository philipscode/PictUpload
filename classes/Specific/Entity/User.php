<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/17/18
 * Time: 9:49 PM
 */

namespace Specific\Entity;


class User
{
    public $id;
    public $name;
    public $email;
    public $password;
    private $picturesTable;

    public function __construct(\General\DatabaseTable $picturesTable)
    {
        $this->picturesTable = $picturesTable;
    }

    public function addPicture($picture)
    {
        $picture['userId'] = $this->id;

        return $this->picturesTable->save($picture);
    }
}