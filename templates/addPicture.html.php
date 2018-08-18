<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="picture[userId]" value="<?=$user->id?>">
    <input type="submit" value="Upload Picture" name="submit">
</form>