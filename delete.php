<?php
include 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM library WHERE id = $id";
    $conn->query($sql);
}
header("Location: index.php");
exit;
?>