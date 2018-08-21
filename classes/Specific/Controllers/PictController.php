<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/13/18
 * Time: 10:29 AM
 */


namespace Specific\Controllers;
use \General\DatabaseTable;


class PictController
{
    private $picturesTable;
    private $usersTable;

    public function __construct(DatabaseTable $picturesTable, DatabaseTable $usersTable)
    {
        $this->picturesTable = $picturesTable;
        $this->usersTable = $usersTable;
    }

    public function listPictures()
    {
        $pictures = $this->picturesTable->findAll();

        $files = glob(__DIR__.'/../../../public/images/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        foreach ($pictures as $picture) {
            copy(__DIR__.'/../../../uploads/' . $picture->name . '.jpg', __DIR__.'/../../../public/images/' . $picture->name . '.jpg');
        }

        return [
            'title' => 'PictUpload',
            'template' => 'listPictures.html.php',
            'variables' => [
                'pictures' => $pictures
            ]
        ];
    }

    public function add()
    {
        return [
            'title' => 'Add Picture',
            'template' => 'addPicture.html.php',
            'variables' => [
                'user' => $this->usersTable->findById(1)
            ]
        ];
    }

    public function save()
    {
        $user = $this->usersTable->findById($_POST['picture']['userId']);
        $picture = $_POST['picture'];
        $picture['date'] = new \DateTime();
        $picture['name'] = basename($_FILES["fileToUpload"]["name"], ".jpg");
        $picture['id'] = null;

        $uploadDir = __DIR__.'/../../../uploads/';
        $uploadFile = $uploadDir . basename($_FILES["fileToUpload"]["name"]);

        if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadFile)) {
            echo 'error';
            header('location: error/upload');
        }

        $pictureEntity = $user->addPicture($picture);

        header("location: /");
    }
}