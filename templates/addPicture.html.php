<form action="" method="post" enctype="multipart/form-data">
    <div class="form-container">
        <input type="text" id="caption" name="picture[caption]" placeholder="Caption" required>
        <input id="file" type="file" name="fileToUpload" id="fileToUpload" required class="inputFile">
        <label for="file">Choose a file...</label>
        <input type="hidden" name="picture[userId]" value="<?=$user->id?>">
        <button type="submit">Upload</button>
    </div>
</form>