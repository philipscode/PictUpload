<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/13/18
 * Time: 10:29 AM
 */


namespace Specific\Controllers;


class PictController
{
    private $picturesTable;

    public function __construct(\General\DatabaseTable $picturesTable)
    {
        $this->picturesTable = $picturesTable;
    }

    public function listPictures()
    {
        $pictures = $this->picturesTable->findAll();

        $files = glob(__DIR__.'/../../../public/images/*');
        echo __DIR__.'../../../public/images/*';
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
}