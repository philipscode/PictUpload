<?php
/**
 * Created by PhpStorm.
 * User: philip
 * Date: 8/24/18
 * Time: 12:20 PM
 */

namespace Specific\Controllers;
use \General\DatabaseTable;


class CommentController
{
    private $commentsTable;
    private $picturesTable;
    private $usersTable;

    public function __construct(DatabaseTable $commentsTable, DatabaseTable $picturesTable, DatabaseTable $usersTable)
    {
        $this->commentsTable = $commentsTable;
        $this->picturesTable = $picturesTable;
        $this->usersTable = $usersTable;
    }

    public function show()
    {
        $pictureId = $_GET['pictureId'];

        $picture = $this->picturesTable->findById($pictureId);
        $comments = $this->commentsTable->find('pictureId', $pictureId);

        return [
            'title' => 'Comments',
            'template' => 'comments.html.php',
            'variables' => [
                'picture' => $picture,
                'comments' => $comments
            ]
        ];
    }

    public function add()
    {
        $comment = $_POST['comment'];
        $comment['date'] = new \DateTime();

        $this->commentsTable->save($comment);
        header('location: /comments?pictureId=' . $comment['pictureId']);
    }
}