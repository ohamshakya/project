<?php
// include("./database/databaseconn.php");
require("./database/databaseconn.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$selectedMsgErr = "";
$sessionUser = $_SESSION['username'];
//selecting user id i.e foreign key of vehicle 
$query = "SELECT id from user  where username = '$sessionUser'";
$res = mysqli_query($conn, $query);
$numRows = mysqli_num_rows($res);
if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $userId = $row['id'];
    }
}

//selecting user_id from vehicle to get vehicle_id via user_id
$sql = "SELECT id from vehicle where user_id = $userId";
$res = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($res);
if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $vehicleId = $row['id'];
    }
}
$vehicleIdExistErr = "";
$selectQuery = "SELECT vehicle_type from vehicle where user_id=$userId";
$result = mysqli_query($conn, $selectQuery);
$numRows = mysqli_num_rows($result);
if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $vehicleType = $row['vehicle_type'];
    }
}

$countQuery = "SELECT COUNT(vehicle_type) from vehicle where user_id = $userId";
$count = mysqli_query($conn, $countQuery);
$numRows = mysqli_num_rows($count);
if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($count)) {
        $vehicleCount = $row['COUNT(vehicle_type)'];
    }
}

//selecting status from parking table
$queryStatus = "SELECT parking_status from parking where parking_status = 'free'";
$result = mysqli_query($conn, $queryStatus);
$numRows = mysqli_num_rows($result);
if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $parkingStatus = $row['status'];
    }
}
// $vehicleIdExist = "SELECT vehicle_id FROM parking where vehicle_id = $vehicleId";
// $result = mysqli_query($conn, $vehicleIdExist);
// $numExistRows = mysqli_num_rows($res);
// if ($numExistRows > 0) {
//     $vehicleIdExistErr = "vehicle exist try another";
// }
$optionErr = "";
if (isset($_POST['vehcile_registered-select'])) {
    $selectedOption = $_POST['vehcile_registered-select'];
    if ($selectedOption == "none") {
        $selectedMsgErr = "please select one";
        // header("Location:selected-user_parking.php");
    } else {

        //  echo $selectedOption;
    }
} else {
    $optionErr =  'No option selected.';
}
// echo $selectedOption;

// echo $selectOption;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/user_parking.css">
    <title>Parking slot</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>

<body>
    <?php include("./include/after-login-nav.php"); ?>
    <section class="register-vehicle">
        <?php echo $parkingStatus; ?>
        <h3>Which vehicle do you want to park.?</h3>
        <p class="para-register">You have
            <?php echo $vehicleCount; ?> registered vehicle
        </p>
        <?php
        if ($vehicleCount == 0) {
            echo "please register vehicle";
        }
        ?>
        <form method="post" action="">
            <div class="vehicle_registered">
                <label for="vehicle-register">Choose registered vehicle to park</label>
                <br>
                <select name="vehcile_registered-select" id="" class="registered-vehicle">
                    <option value="none">--name--of--registered--vehicle</option>
                    <?php $sql = "SELECT vehicle_type,id  FROM vehicle where user_id = $userId";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <option value="<?php echo $vehicleSelect = $row['id']; ?>"> <?php echo $row['vehicle_type']; ?>
                            </option>
                            </option>
                        <?php }
                    } ?>
                    </option>
                </select>
                <div class="error">
                    <?php echo $selectedMsgErr;?>
                    <?php echo $optionErr;?>
                </div>
            </div>
            <br>
            <?php echo  '<button class="button-extract"><a class="select-option" href="user_parking.php?query='.$selectedOption.'">'.$selectedOption.'"submit"</a></button>';?>
        </form>
    </section>
    <div class="error">
        <?php echo $vehicleIdExistErr; ?>
    </div>


    <!-- </div>
    </div> -->
    <div class="footer-select-option">
        <?php include("./include/footer.php"); ?>
    </div>

</body>

</html>