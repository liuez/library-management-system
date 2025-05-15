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
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding: 40px; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select { padding: 10px; width: 100%; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover { background-color: #45a049; }
        .back-link { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #333; }
    </style>
</head>
<body>
    <h2 style="text-align:center">➕ Add New Book</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="book_title" required>

        <label>Author:</label>
        <input type="text" name="author_name" required>

        <label>Cover:</label>
        <input type="file" name="book_cover" required>

        <label>Genre:</label>
        <select name="genre">
            <option value="Fiction">Fiction</option>
            <option value="Non-fiction">Non-fiction</option>
            <option value="Biography">Biography</option>
        </select>

        <label>Publication Year:</label>
        <input type="number" name="publication_year" min="1900" max="2099">

        <label>Quantity:</label>
        <input type="number" name="quantity" min="1" value="1">

        <input type="submit" value="Submit" class="button">
    </form>
    <a href="index.php" class="back-link">← Return to Book List</a>
</body>
</html>