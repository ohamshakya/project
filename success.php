<?php
require("./database/databaseconn.php");
if (isset($_GET['ticketId']) && ($_GET['userId'])) {
    // if (isset($_GET['param2'])) {
       echo $ticketId = $_GET['ticketId'];
        echo $userId = $_GET['userId'];
    // }    

    $sql = "SELECT ticket_number from ticket where ticket_id = $ticketId";
    $res = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($res);
    while($row=mysqli_fetch_assoc($res)){
        $ticket_number = $row['ticket_number'];
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap-5.3.0-dist/css/bootstrap.min.css">
    <title>Transaction</title>
    <style>
        body{
            height: 100vh;
        }
    </style>
</head>
<body>
<div class="alert alert-success d-flex justify-content-center items-center mt-4 w-50" role="alert">
  Payment Successfull <a href="user.php" class="alert-link">home</a>.
</div>


<script src="./assets/bootstrap/bootstrap-5.3.0-dist/js/bootstrap.min.js"></script>
</body>
</html>