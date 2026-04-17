<?php
include 'db.php';
$id = $_GET['id'];

mysqli_query($conn, "UPDATE tasks SET status='Completed' WHERE id=$id");

header("Location: index.php");
?>