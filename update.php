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
</head>
<body>
    <h2>Edit Book</h2>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label>Title:</label><br>
        <input type="text" name="book_title" value="<?php echo $row['book_title']; ?>" required><br><br>

        <label>Author:</label><br>
        <input type="text" name="author_name" value="<?php echo $row['author_name']; ?>" required><br><br>

        <label>Cover (leave empty to keep current):</label><br>
        <input type="file" name="book_cover"><br><br>

        <label>Genre:</label><br>
        <select name="genre">
            <option value="Fiction" <?php if ($row['genre'] == 'Fiction') echo 'selected'; ?>>Fiction</option>
            <option value="Non-fiction" <?php if ($row['genre'] == 'Non-fiction') echo 'selected'; ?>>Non-fiction</option>
            <option value="Biography" <?php if ($row['genre'] == 'Biography') echo 'selected'; ?>>Biography</option>
        </select><br><br>

        <label>Publication Year:</label><br>
        <input type="number" name="publication_year" value="<?php echo $row['publication_year']; ?>"><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>"><br><br>

        <input type="submit" value="Update">
    </form>
    <br>
    <a href="index.php">Return to Main Page</a>
</body>
</html>