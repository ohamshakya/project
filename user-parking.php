<?php
require("./database/databaseconn.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
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
$queryOne = "SELECT vehicle_id from parking where vehicle_id = $vehicleId";
$res = mysqli_query($conn, $queryOne);
$numExistRows = mysqli_num_rows($res);
if ($numExistRows > 0) {
    echo "<script>alert('vehicle already exist in parking slot');</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/user_parking.css">
    <title>Document</title>
    <style>
        .footer-user-parking {
            width: 100%;
            margin-top: 12.6%;
        }
    </style>
</head>

<body>
    <?php include("./include/after-login-nav.php"); ?>
    <h1 class="parking-header">Choose parking slot for parking</h1>
    <div class="box-wrapper">

        <?php
        include("./database/databaseconn.php");
        $sql = "SELECT parkingslot_number  from parking where parking_status = 'free'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $parkingNumber = $row['parkingslot_number'];
                echo ' <div class="box">
                    
                         <button class="button-remove"><a class="parking-lot" href="parking-slotvehicle.php?q=' . urlencode($parkingNumber) . '">' . $parkingNumber . '</a></button>
   
                                
                        </div>';


            }
            // echo "</table>";
        
        } else {
            echo "0 result";
        }
        ?>
    </div>
    <div class="error">
        <?php echo $vehicleIdExistErr; ?>
    </div>
    <div class="footer-user-parking">
        <?php include("./include/footer.php"); ?>
    </div>
</body>

</html>