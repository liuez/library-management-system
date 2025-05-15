<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_title = $_POST['book_title'];
    $author_name = $_POST['author_name'];
    $genre = $_POST['genre'];
    $publication_year = $_POST['publication_year'];
    $quantity = $_POST['quantity'];
    $cover = addslashes(file_get_contents($_FILES['book_cover']['tmp_name']));

    $sql = "INSERT INTO library (book_title, author_name, book_cover, genre, publication_year, quantity) VALUES ('$book_title', '$author_name', '$cover', '$genre', '$publication_year', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
</head>
<body>
    <h2>Add New Book</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label>Title:</label><br>
        <input type="text" name="book_title" required><br><br>

        <label>Author:</label><br>
        <input type="text" name="author_name" required><br><br>

        <label>Cover:</label><br>
        <input type="file" name="book_cover" required><br><br>

        <label>Genre:</label><br>
        <select name="genre">
            <option value="Fiction">Fiction</option>
            <option value="Non-fiction">Non-fiction</option>
            <option value="Biography">Biography</option>
        </select><br><br>

        <label>Publication Year:</label><br>
        <input type="number" name="publication_year" min="1900" max="2099"><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" min="1" value="1"><br><br>

        <input type="submit" value="Submit">
    </form>
    <br>
    <a href="index.php">Return to Main Page</a>
</body>
</html>
