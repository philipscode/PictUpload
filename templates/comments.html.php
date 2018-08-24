<div class="content">
    <?php if (isset($_SESSION['id']) && $_SESSION['id'] === $picture->getUser()->id): ?>
        <form action="/picture/delete" method="post" id="delete-form">
            <input type="hidden" name="pictureId" value="<?=$picture->id?>">
            <button type="submit" id="delete-button">X</button>
        </form>
    <?php endif; ?>
    <div class="info">
        <p id="user">Posted by <?=$picture->getUser()->name?></p>
        <p id="pubDate"><?=$picture->date?></p>
    </div>
    <h1><?=$picture->caption?></h1>
    <img src="images/<?=$picture->name . '.jpg'?>">
    <a href="/comments?pictureId=<?=$picture->id?>">comments</a>
</div>
<div class="comments">
    <?php foreach ($comments as $comment): ?>
    <div class="info">
        <p><?=$comment->getUser()->name?></p>
        <p><?=$comment->date?></p>
    </div>
    <div class="comment-text">
        <p><?=$comment->text?></p>
    </div>
    <?php endforeach; ?>
</div>
<?php if (isset($_SESSION['id'])): ?>
<div class="add-comment">
    <form action="/comments/add" method="post">
        <input type="hidden" name="comment[userId]" value="<?=$picture->getUser()->id?>">
        <input type="hidden" name="comment[pictureId]" value="<?=$picture->id?>">
        <textarea name="comment[text]" rows="3" cols="40" required></textarea>
        <input type="submit">
    </form>
</div>
<?php endif; ?>