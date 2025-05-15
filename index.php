<?php
include 'db.php';
$result = $conn->query("SELECT * FROM library");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book List</title>
</head>
<body>
    <h2>Library System: Book List</h2>
    <a href="create.php">Add New Book</a>
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>Cover</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Year</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td>
                <?php
                if ($row['book_cover']) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['book_cover']) . '" width="80"/>';
                } else {
                    echo 'No Image';
                }
                ?>
            </td>
            <td><?php echo $row['book_title']; ?></td>
            <td><?php echo $row['author_name']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td><?php echo $row['publication_year']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>
                <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
