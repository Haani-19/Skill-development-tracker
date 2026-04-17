<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Tasks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
  <a href="index.php">Home</a>
  <a href="view.php">View Tasks</a>
  <a href="progress.php">Progress</a>
  <a href="about.php">About</a>
</nav>

<div class="container">
    <h2>All Tasks</h2>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="task <?php echo ($row['status']=='Completed')?'completed':'pending'; ?>">
            <strong><?php echo $row['task_name']; ?></strong><br>
            Skill: <?php echo $row['skill']; ?><br>
            Deadline: <?php echo $row['deadline']; ?><br>
            Status: <?php echo $row['status']; ?>
        </div>
    <?php } ?>

</div>

</body>
</html>