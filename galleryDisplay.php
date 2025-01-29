<?php
include 'includes/connect.php';
include 'includes/header.php'
?>

<div class="gallery-container">
    <?php
    $stmt = $pdo->query("SELECT * FROM images ORDER BY created_at DESC");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='gallery-item'>";
        echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['title']) . "' />";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "</div>";
    }
include 'includes/footer.php'
    ?>
</div>
