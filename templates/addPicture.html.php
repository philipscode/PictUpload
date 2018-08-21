<form action="" method="post" enctype="multipart/form-data">
    <div class="form-container">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="hidden" name="picture[userId]" value="<?=$user->id?>">
        <button type="submit">Upload</button>
    </div>
</form>