<?php
    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "task1_robot";
    $feedback = "";
    $conn = mysqli_connect($servername, $username, $password, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    function update($base, $shoulder, $elbow, $wrist, $gripper,$engin6, $power){
        global $conn;

        $query = "UPDATE robot SET base = ".$base.", shoulder = ".$shoulder.", elbow = ".$elbow.", wrist = ".$wrist.", gripper = ".$gripper.", engin6 = ".$engin6.",power = ".$power;
        $result = mysqli_query($conn, $query);
        if(!$result)
            echo $conn->error;
        return $result;

    }

    function getValues(){
        global $conn;

        $query = "SELECT * FROM robot";
        $result = mysqli_query($conn, $query);
        if(!$result)
            echo $conn->error;

        return ($result->fetch_assoc());
    }


    if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
        if(isset($_POST["save"]) && $_POST["save"] == "SAVE")
            $_POST["power"] = 0;
        else
            $_POST["power"] = 1;


        if(update($_POST['base'], $_POST['shoulder'], $_POST['elbow'], $_POST['wrist'], $_POST['gripper'],$_POST["e6"], $_POST['power']))
            $feedback = "<p style='color:green'>data have been saved successfuly</p>";
        else
            $feedback = "<p style='color:red'>Save Failed!!</p>";
    }

    $angles =  getValues();


 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Move the robot by adjusting its engins</h1>

    <form class="" action="Gui.php" method="post">
        <fieldset>
            <div class="engin">
                <label for="base">Base </label>
                <input type="range" id="base" name="base" min="0" max="360" value =<?php echo $angles['base']; ?>   />
                <span class="angle"></span>
            </div>

            <div class="engin">
                <label for="shoulder">Shoulder </label>
                <input type="range" id="shoulder" name="shoulder" min="0" max="180" value=<?php echo $angles['shoulder']; ?> />
                <span class="angle"></span>
            </div>

            <div class="engin">
                <label for="elbow">Elbow </label>
                <input type="range" id="elbow" name="elbow" min="0" max="90" value=<?php echo $angles['elbow']; ?> />
                <span class="angle"></span>
            </div>

            <div class="engin">
                <label for="wrist">Wrist </label>
                <input type="range" id="wrist" name="wrist" min="0" max="90" value=<?php echo $angles['wrist']; ?> />
                <span class="angle"></span>
            </div>

            <div class="engin">
                <label for="gripper">Gripper </label>
                <input type="range" id="gripper" name="gripper" min="0" max="90" value=<?php echo $angles['gripper']; ?> />
                <span class="angle"></span>
            </div>

            <div class="engin">
                <label for="e6">Engin 6 </label>
                <input type="range" id="e6" name="e6" min="0" max="90" value=<?php echo $angles['engin6']; ?> />
                <span class="angle"></span>
            </div>

            <div class="btns">
                <input type="submit" name="save" value="SAVE">
                <input type="submit" name="operate" value="OPERATE">

            </div>
            <?php echo $feedback; ?>
        </fieldset>

    </form>
    <script src="script.js"></script>
</body>

</html>
