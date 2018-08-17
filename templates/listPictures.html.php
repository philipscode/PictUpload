<?php foreach ($pictures as $picture): ?>
<div class="content">
    <img src="images/<?=$picture->name . '.jpg'?>">
    <h4><?=$picture->getUser()->name?></h4>
    <p><?=$picture->date?></p>
</div>
<?php endforeach; ?>
