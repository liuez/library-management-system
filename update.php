<?php
include 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM library WHERE id = $id");
    $row = $result->fetch_assoc();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $book_title = $_POST['book_title'];
    $author_name = $_POST['author_name'];
    $genre = $_POST['genre'];
    $publication_year = $_POST['publication_year'];
    $quantity = $_POST['quantity'];

    if ($_FILES['book_cover']['size'] > 0) {
        $cover = addslashes(file_get_contents($_FILES['book_cover']['tmp_name']));
        $sql = "UPDATE library SET book_title='$book_title', author_name='$author_name', book_cover='$cover', genre='$genre', publication_year='$publication_year', quantity='$quantity' WHERE id=$id";
    } else {
        $sql = "UPDATE library SET book_title='$book_title', author_name='$author_name', genre='$genre', publication_year='$publication_year', quantity='$quantity' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding: 40px; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select { padding: 10px; width: 100%; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        .button {
            background-color: #2196F3;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover { background-color: #1976D2; }
        .back-link { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #333; }
    </style>
</head>
<body>
    <h2 style="text-align:center">✏️ Edit Book</h2>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label>Title:</label>
        <input type="text" name="book_title" value="<?php echo $row['book_title']; ?>" required>

        <label>Author:</label>
        <input type="text" name="author_name" value="<?php echo $row['author_name']; ?>" required>

        <label>Cover (leave blank to keep current):</label>
        <input type="file" name="book_cover">

        <label>Genre:</label>
        <select name="genre">
            <option value="Fiction" <?php if ($row['genre'] == 'Fiction') echo 'selected'; ?>>Fiction</option>
            <option value="Non-fiction" <?php if ($row['genre'] == 'Non-fiction') echo 'selected'; ?>>Non-fiction</option>
            <option value="Biography" <?php if ($row['genre'] == 'Biography') echo 'selected'; ?>>Biography</option>
        </select>

        <label>Publication Year:</label>
        <input type="number" name="publication_year" value="<?php echo $row['publication_year']; ?>">

        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>">

        <input type="submit" value="Update" class="button">
    </form>
    <a href="index.php" class="back-link">← Return to Book List</a>
</body>
</html>
