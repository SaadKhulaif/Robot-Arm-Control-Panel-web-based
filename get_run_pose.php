<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "robot_actions";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT servo1, servo2, servo3, servo4, servo5, servo6, status FROM run";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Current Run Pose</title>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 16px;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

<h1>Current Run Pose</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>servo 1</th>
            <th>servo 2</th>
            <th>servo 3</th>
            <th>servo 4</th>
            <th>servo 5</th>
            <th>servo 6</th>
            <th>Status</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['servo1']) ?></td>
            <td><?= htmlspecialchars($row['servo2']) ?></td>
            <td><?= htmlspecialchars($row['servo3']) ?></td>
            <td><?= htmlspecialchars($row['servo4']) ?></td>
            <td><?= htmlspecialchars($row['servo5']) ?></td>
            <td><?= htmlspecialchars($row['servo6']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No run pose found.</p>
<?php endif; ?>



<script>
  
    window.addEventListener("load", function () {
    fetch("update_status.php")
      .then(response => response.text())
      .then(data => console.log("Status update:", data))
      .catch(error => console.error("Error updating status:", error));
  });
</script>

</body>
</html>
