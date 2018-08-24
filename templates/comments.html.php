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
</div>
<div class="comments">
    <?php foreach ($comments as $comment): ?>
    <div class="comment">
        <div class="info">
            <p><?=$comment->getUser()->name?></p>
            <p><?=$comment->date?></p>
        </div>
        <div class="comment-text">
            <p><?=$comment->text?></p>
        </div>
    </div>
    <?php endforeach; ?>
    <?php if (isset($_SESSION['id'])): ?>
    <div class="add-comment">
        <form action="/comments/add" method="post">
            <input type="hidden" name="comment[userId]" value="<?=$_SESSION['id']?>">
            <input type="hidden" name="comment[pictureId]" value="<?=$picture->id?>">
            <textarea name="comment[text]" rows="3" cols="40" required></textarea>
            <button type="submit">comment</button>
        </form>
    </div>
    <?php endif; ?>
</div>

