<?php
include 'db.php';
$result = $conn->query("SELECT * FROM library");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book List</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding: 30px; }
        h2 { color: #333; }
        .button {
            display: inline-block;
            padding: 8px 16px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .button:hover { background-color: #45a049; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        img { border-radius: 4px; }
    </style>
</head>
<body>
    <h2>📚 Library System - Book List</h2>
    <a href="create.php" class="button">➕ Add New Book</a>
    <br><br>
    <table>
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
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['book_cover']) . '" width="60"/>';
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
                <a class="button" style="background:#2196F3" href="update.php?id=<?php echo $row['id']; ?>">✏️ Edit</a>
                <a class="button" style="background:#03a9f4" href="view.php?id=<?php echo $row['id']; ?>">🔍 View</a>
                <a class="button" style="background:#f44336" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">🗑️ Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
