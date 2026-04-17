<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php';

// Load XML
$xml = simplexml_load_file("skills.xml");

// Add Task
if (isset($_POST['add'])) {
    $skill = $_POST['skill'];
    $task = $_POST['task'];
    $deadline = $_POST['deadline'];

    mysqli_query($conn, "INSERT INTO tasks (skill, task_name, deadline, status)
    VALUES ('$skill', '$task', '$deadline', 'Pending')");
}

// Fetch tasks
$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");

// Stats
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tasks"));
$completed = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tasks WHERE status='Completed'"));
$progress = ($total > 0) ? round(($completed / $total) * 100) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Skill Tracker</title>
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
    <h2>Skill Development Tracker</h2>

    <p><strong>Total:</strong> <?php echo $total; ?> |
       <strong>Completed:</strong> <?php echo $completed; ?></p>

    <p><strong>Progress:</strong> <?php echo $progress; ?>%</p>

    <div style="background:#ddd; border-radius:10px;">
        <div style="width:<?php echo $progress; ?>%; background:#4CAF50; color:white; padding:5px; border-radius:10px;">
            <?php echo $progress; ?>%
        </div>
    </div>

    <form method="POST">
        <select name="skill">
            <?php foreach ($xml->skill as $s) { echo "<option>$s</option>"; } ?>
        </select>

        <input type="text" name="task" placeholder="Enter Task" required>
        <input type="date" name="deadline" required>

        <button type="submit" name="add">Add Task</button>
    </form>

    <h3>Recent Tasks</h3>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="task <?php echo ($row['status']=='Completed')?'completed':'pending'; ?>">
            <strong><?php echo $row['task_name']; ?></strong><br>
            Skill: <?php echo $row['skill']; ?><br>
            Deadline: <?php echo $row['deadline']; ?><br>
            Status: <?php echo $row['status']; ?><br>

            <a href="update.php?id=<?php echo $row['id']; ?>">✔</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')">❌</a>
        </div>
    <?php } ?>

</div>

</body>
</html>