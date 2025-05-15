<?php
$host = "localhost";
$user = "root";          // 默认用户
$password = "";          // 默认无密码
$database = "library_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error); // Connection failed
}
?>
