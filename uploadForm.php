// form that it will allow users to upload images

<form action="index.php" method="POST" enctype="multipart/form-data">
    <label for="image">Choose an image to upload:</label>
    <input type="file" name="image" id="image" required>
    <button type="submit" name="upload">Upload</button>
</form>
