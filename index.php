
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "robot_actions";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM pose WHERE id = $id");
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}


if (isset($_GET['load_id'])) {
    $id = intval($_GET['load_id']);
    $res = $conn->query("SELECT * FROM pose WHERE id = $id");
    echo json_encode($res->fetch_assoc());
    exit();
}





if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['servo1']) && $_POST['run_action'] != "1") {
    $servo1 = intval($_POST['servo1']);
    $servo2 = intval($_POST['servo2']);
    $servo3 = intval($_POST['servo3']);
    $servo4 = intval($_POST['servo4']);
    $servo5 = intval($_POST['servo5']);
    $servo6 = intval($_POST['servo6']);

    $stmt = $conn->prepare("INSERT INTO pose (servo1, servo2, servo3, servo4, servo5, servo6) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiii", $servo1, $servo2, $servo3, $servo4, $servo5, $servo6);
    $stmt->execute();
    $stmt->close();
}





if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['run_action']) && $_POST['run_action'] == "1") {
    $servo1 = intval($_POST['servo1']);
    $servo2 = intval($_POST['servo2']);
    $servo3 = intval($_POST['servo3']);
    $servo4 = intval($_POST['servo4']);
    $servo5 = intval($_POST['servo5']);
    $servo6 = intval($_POST['servo6']);

    
    $conn->query("DELETE FROM run");

    $stmt = $conn->prepare("INSERT INTO run (servo1, servo2, servo3, servo4, servo5, servo6,status) VALUES (?, ?, ?, ?, ?, ?,1)");
    $stmt->bind_param("iiiiii", $servo1, $servo2, $servo3, $servo4, $servo5, $servo6);
    $stmt->execute();
    $stmt->close();
}






$result = $conn->query("SELECT id, servo1, servo2,servo3,servo4,servo5,servo6 FROM pose ORDER BY id ASC");
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css" type="text/css">

        
</head>



<body>
    

<h1>Robot Arm Control Panel</h1>

    <form method= "POST">

        <div class="motor-control">
            <label for="motor1">Motor 1:</label>
            <input type="range" id="motor1" name="servo1" min="1" max="180" value="90" oninput="updateValue(this)">
            <span id="val_motor1">90</span>
        </div>

        <div class="motor-control">
            <label for="motor2">Motor 2:</label>
            <input type="range" id="motor2" name="servo2" min="1" max="180" value="90" oninput="updateValue(this)">
            <span id="val_motor2">90</span>
        </div>

        <div class="motor-control">
            <label for="motor3">Motor 3:</label>
            <input type="range" id="motor3" name="servo3" min="1" max="180" value="90" oninput="updateValue(this)">
            <span id="val_motor3">90</span>
        </div>

        <div class="motor-control">
            <label for="motor4">Motor 4:</label>
            <input type="range" id="motor4" name="servo4" min="1" max="180" value="90" oninput="updateValue(this)">
            <span id="val_motor4">90</span>
        </div>

        <div class="motor-control">
            <label for="motor5">Motor 5:</label>
            <input type="range" id="motor5" name="servo5" min="1" max="180" value="90" oninput="updateValue(this)">
            <span id="val_motor5">90</span>
        </div>

        <div class="motor-control">
            <label for="motor6">Motor 6:</label>
            <input type="range" id="motor6" name="servo6" min="1" max="180" value="90" oninput="updateValue(this)">
            <span id="val_motor6">90</span>
        </div>

        <div class="button-group">
            <button type="button" onclick="resetSliders()">Reset</button>
            <button type="submit">Save Pose</button>
            <button type="button" onclick="submitRunPose()">Run</button>
        </div>

        <input type="hidden" name="run_action" id="run_action" value="0">

    </form>



    <div style="height: 2em;"></div>
    

      <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Motor 1</th>
            <th>Motor 2</th>
            <th>Motor 3</th>
            <th>Motor 4</th>
            <th>Motor 5</th>
            <th>Motor 6</th>
            <th class="action-col">Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr data-id="<?= $row['id'] ?>">

            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['servo1']) ?></td>
            <td><?= htmlspecialchars($row['servo2']) ?></td>
            <td><?= htmlspecialchars($row['servo3']) ?></td>
            <td><?= htmlspecialchars($row['servo4']) ?></td>
            <td><?= htmlspecialchars($row['servo5']) ?></td>
            <td><?= htmlspecialchars($row['servo6']) ?></td>
            
            <td class="action-col">
            
                <button type="button" onclick="loadPose(<?= $row['id'] ?>)">Load</button>
                <button type="button" onclick="removePose(<?= $row['id'] ?>)">Remove</button>
        
            </td>

        </tr>
        <?php endwhile; ?>
    </table>




    <script>

        function updateValue(slider) {
        const span = document.getElementById('val_' + slider.id);
        span.textContent = slider.value;

        updateSliderGradient(slider);
        }


        function resetSliders() {
        for (let i = 1; i <= 6; i++) {
            const slider = document.getElementById('motor' + i);
            slider.value = 90;
            updateValue(slider); 
        }
        }


        function savePose() {
        let values = [];
        for (let i = 1; i <= 6; i++) {
            values.push(document.getElementById('motor' + i).value);
        }
        
        }



        function submitRunPose() {
        
        document.getElementById("run_action").value = "1";

        
        document.querySelector("form").submit();
        }




        function updateSliderGradient(slider) {
        const min = slider.min || 0;
        const max = slider.max || 100;
        const val = slider.value;
        const percent = ((val - min) / (max - min)) * 100;
        slider.style.background = `linear-gradient(to right, #3399ff ${percent}%, #ccc ${percent}%)`;
        }



        function loadPose(id) {
        fetch('?load_id=' + id)
        .then(res => res.json())
        .then(data => {
        for (let i = 1; i <= 6; i++) {
        let val = data['servo' + i];
        let slider = document.getElementById('motor' + i);
        slider.value = val;
        updateValue(slider);
        }
        });
        }
        function removePose(id) {
        if (confirm("Are you sure you want to delete this pose?")) {
        window.location.href = '?delete_id=' + id;
        }
        }


        
        document.querySelectorAll('input[type="range"]').forEach(slider => {
        updateValue(slider); 
        slider.addEventListener('input', () => updateValue(slider));
        })

    </script>



</body>

</html>
