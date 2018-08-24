<?php foreach ($pictures as $picture): ?>
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
<?php endforeach; ?>
