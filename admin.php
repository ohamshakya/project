<?php
require("./database/databaseconn.php");
require("./database/adminselect.php");
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/admin_dashboard.css">
    <!-- <script src="showhide.js"></script> -->
    <title>Dashboard</title>
</head>

<body>
    <div class="navigation_wrapper">
        <section class="navigation">
            <div class="nav-wrapper">
                <div class="head_nav">
                    <h1>Dashboard</h1>
                    <span class="dash_img"><img src="./assets/icons/Dashboard.svg" alt="dashboard">
                    </span>
                </div>
                <div class="account">
                    <img src="./assets/icons/Administrator Male.svg" alt="admin_male">
                </div>
            </div>
        </section>
    </div>
    <aside class="sidebar">

        <h2 class="logo" style="text-align: center; color:white">VPMS</h2>
        <div class="admin_name">
            <img class="admin-img" src="./assets/icons/Administrator Male (1).svg" alt="">
            <span>
                <?php echo $_SESSION['admin']; ?>
            </span>
        </div>
        <div class="all_wrapper">
            <div class="sidebar_content">
                <ul class="sidebar-content-items">
                    <li>
                        <span class="image">
                            <a class="tablinks" id="defaultOpen" onclick="showContent(event, 'main_content')"
                                href="#">Home</a>
                        </span>
                    </li>
                    <li>
                        <span class="image">
                            <a href="#">
                                <img class="sidebar-img" src="./assets/icons/Add New.svg" alt="addnew">
                            </a>
                            <a class="tablinks" onclick="showContent(event, 'add_vehicle')" href="#">Add Vehicle</a>
                        </span>
                    </li>
                    <li>
                        <span class="image">
                            <a href="#">
                                <img class="sidebar-img" src="./assets/icons/Category.svg" alt="category">
                            </a>
                            <a class="tablinks" onclick="showContent(event, 'category')" href="#">Category</a>
                        </span>
                    </li>
                    <li>
                        <span class="image">
                            <a href="#">
                                <img class="sidebar-img" src="./assets/icons/Book online.svg" alt="Booking">
                            </a>
                            <a class="tablinks" onclick="showContent(event, 'booking')" href="#">Membership</a>
                        </span>

                    </li>
                    <li>
                        <span class="image">
                            <a href="#">
                                <img class="sidebar-img" src="./assets/icons/Parking.svg" alt="parking">
                            </a>
                            <a class="tablinks" onclick="showContent(event, 'parking')" href="#">Parking</a>
                        </span>
                    </li>
                    <li>
                        <span class="image">
                            <a href="#">
                                <img class="sidebar-img" src="./assets/icons/Payments.svg" alt="payment">
                            </a>
                            <a class="tablinks" onclick="showContent(event, 'payment')" href="#">Payment</a>
                        </span>
                    </li>
                    <li>
                        <span class="image">
                            <a href="./logout.php">
                                <img class="sidebar-img" src="./assets/icons/Logout.svg" alt="logout">
                            </a>
                            <a href="./logout.php">logout</a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <main>
        <div class="tabcontent" id="main_content">
            <div class="adminname-display">
                <h2>Hello
                    <?php echo $_SESSION['admin']; ?>
                </h2>
                <h3 class="welcome">Welcome to the administrator dashboard</h3>
            </div>
            <div class="box-wrapper--one">
                <div class="box_car">
                    <div class="box_car-item">
                        <div class="number">
                            <?php fourWheelerCount(); ?>
                        </div>
                        <div class="car_logo">
                            <img src="./assets/icons/Directions car.svg" alt="">
                        </div>

                    </div>
                    <div class="head">Total four wheeler</div>
                    <div class="more_info">
                        <p>More info</p><span><img src="./assets/icons/More Info.svg" alt=""></span>
                    </div>
                </div>
                <div class="box_bike">
                    <div class="box_bike-item">
                        <div class="number">
                            <?php twoWheelerCount(); ?>
                        </div>
                        <div class="bike_logo">
                            <img src="./assets/icons/bike.svg" alt="">
                        </div>
                    </div>
                    <div class="head">
                        Total two wheeler
                    </div>
                    <div class="more_info">
                        <p>More info</p><span><img src="./assets/icons/More Info.svg" alt=""></span>
                    </div>
                </div>
            </div>
            <div class="box-wrapper--two">
                <div class="box_parking">
                    <div class="box_parking-item">
                        <div class="number">
                            <?php parkingCount();?>
                        </div>
                        <div class="parking_logo">
                            <img src="./assets/icons/parking.svg" alt="">
                        </div>

                    </div>
                    <div class="head">Parking Slot</div>
                    <div class="more_info">
                        <p>More info</p><span><img src="./assets/icons/More Info.svg" alt=""></span>
                    </div>
                </div>
                <div class="box_booking">
                    <div class="box_booking-item">
                        <div class="number">
                            <?php membershipCount();?>
                        </div>
                        <div class="booking_logo">
                            <img src="./assets/icons/booking.png" alt="">
                        </div>

                    </div>
                    <div class="head">Membership</div>
                    <div class="more_info">
                        <p>More info</p><span><img src="./assets/icons/More Info.svg" alt=""></span>
                    </div>
                </div>

            </div>
        </div>
        <div style="margin-left:16%; margin-top: 2%; margin-bottom: 1%;" class="tabcontent" id="add_vehicle">
            <?php include("./add_vehicle.php"); ?>
        </div>
        <div style="margin-left:14%; margin-top: 2%; margin-bottom: 1%;" class="tabcontent" id="category">
            <!-- <h2 class="v_category">Vehicle Category</h2> -->
            <?php include("./vehicle_category.php"); ?>
        </div>
        <div style="margin-left:16%; margin-top: 3%; margin-bottom: 1%;" class="tabcontent" id="booking">
            <?php include("./admin-membership.php");?>
        </div>
        <div style="margin-left:16%; margin-top: 2%; margin-bottom:1%;" class="tabcontent" id="parking">
            <?php include("./admin-parking.php");?>
        </div>
        <div style="margin-left:16%; margin-top: 3%; margin-bottom: 1%;" class="tabcontent" id="payment">
            <?php include("./showpayment.php");?>
        </div>
    </main>
    <footer>
        <div class="copyright_wrapper">
            <div class="copyright">
                <p style="margin-bottom: 0;">&copy; All rights reserved
                    <?php echo date('Y'); ?> vehicle parking management system
                </p>
            </div>
        </div>
    </footer>
    <script src="showhide.js"></script>
</body>
</html>