<?php 
include 'includes/connect.php';
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $image = $_FILES["image"];

    $allowedTypes = ["image/jpeg", "image/png"];
    $imageType = mime_content_type($image["tmp_name"]);
    if (!in_array($imageType, $allowedTypes)) {
        die("Invalid image type. Only JPG and PNG are allowed.");
    }

    // this will handle the file upload
    $imagePath = "uploads/" . basename($image["name"]);
    if (move_uploaded_file($image["tmp_name"], $imagePath)) {
        // I will resize image with GD
        list($width, $height) = getimagesize($imagePath);
        $newWidth = 800;
        $newHeight = (int)($height * ($newWidth / $width));
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        if ($imageType == "image/jpeg") {
            $src = imagecreatefromjpeg($imagePath);
        } else {
            $src = imagecreatefrompng($imagePath);
        }

        imagecopyresampled($resizedImage, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // and save the resized image
        $resizedPath = "resized/" . basename($image["name"]);
        imagejpeg($resizedImage, $resizedPath);

        // insert the image into database
        $stmt = $pdo->prepare("INSERT INTO images (title, description, image_path) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $resizedPath]);

        echo "Image uploaded successfully!";
    } else {
        echo "Error uploading the image.";
    }
}
include 'includes/footer.php';
?>

<!-- Upload Form -->
<form action="index.php" method="post" enctype="multipart/form-data">
    <label for="title">Image Title:</label>
    <input type="text" name="title" required><br>

    <label for="description">Image Description:</label>
    <textarea name="description" required></textarea><br>

    <label for="image">Select Image to Upload:</label>
    <input type="file" name="image" accept="image/jpeg, image/png" required><br>

    <input type="submit" value="Upload Image">
</form>
