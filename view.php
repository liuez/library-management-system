<?php
include 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM library WHERE id = $id");
    $row = $result->fetch_assoc();
} else {
    echo "Invalid book ID.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Details</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f3f3; padding: 40px; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .cover-img { width: 200px; border-radius: 8px; margin-bottom: 20px; }
        .label { font-weight: bold; }
        a.button { background: #4CAF50; color: white; padding: 10px 20px; display: inline-block; border-radius: 5px; text-decoration: none; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book Details</h2>
        <?php if ($row['book_cover']) { ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['book_cover']); ?>" class="cover-img">
        <?php } else { echo "<p>No cover image available.</p>"; } ?>

        <p><span class="label">Title:</span> <?php echo $row['book_title']; ?></p>
        <p><span class="label">Author:</span> <?php echo $row['author_name']; ?></p>
        <p><span class="label">Genre:</span> <?php echo $row['genre']; ?></p>
        <p><span class="label">Publication Year:</span> <?php echo $row['publication_year']; ?></p>
        <p><span class="label">Quantity:</span> <?php echo $row['quantity']; ?></p>

        <a href="index.php" class="button">← Back to Book List</a>
    </div>
</body>
</html>