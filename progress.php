<?php
include 'db.php';

// Count tasks
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tasks"));
$completed = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tasks WHERE status='Completed'"));
$pending = $total - $completed;

// Percentages
$completed_percent = ($total > 0) ? ($completed / $total) * 100 : 0;
$pending_percent = ($total > 0) ? ($pending / $total) * 100 : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Progress</title>
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
    <h2>Progress Overview</h2>

    <p><strong>Total Tasks:</strong> <?php echo $total; ?></p>
    <p><strong>Completed:</strong> <?php echo $completed; ?></p>
    <p><strong>Pending:</strong> <?php echo $pending; ?></p>

    <h3>Progress Graph</h3>

    <!-- Simple Bar Graph -->
    <div style="margin-top:20px;">
        
        <p>Completed</p>
        <div style="background:#ddd; border-radius:10px;">
            <div style="width:<?php echo $completed_percent; ?>%; background:#4CAF50; color:white; padding:8px; border-radius:10px;">
                <?php echo round($completed_percent); ?>%
            </div>
        </div>

        <p>Pending</p>
        <div style="background:#ddd; border-radius:10px;">
            <div style="width:<?php echo $pending_percent; ?>%; background:#ff4d4d; color:white; padding:8px; border-radius:10px;">
                <?php echo round($pending_percent); ?>%
            </div>
        </div>

    </div>

</div>

</body>
</html>