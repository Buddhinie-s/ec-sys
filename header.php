<?php
session_start(); // when we use sessions at the hedder file we can use session at any ware in the project
//To check if session variable is not set direct to login page
if (!isset($_SESSION['USERID'])) {
    header("Location:login.php");
}
include 'config.php';
include 'function.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>E&C - Dashboard</title>
        <link href="<?= SYSTEM_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?= SYSTEM_PATH ?>assets/css/dashboard.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATH ?>assets/css/theme-ncpa.css" rel="stylesheet">
        <script src="<?= SYSTEM_PATH ?>assets/js/sweetalert2.all.js" type="text/javascript"></script>
        <link href="<?= SYSTEM_PATH ?>assets/css/notificationButton.css" rel="stylesheet" type="text/css"/>
        <link href="<?= SYSTEM_PATH ?>assets/css/cdn.jsdelivr.net_npm_bootstrap-icons@1.7.2_font_bootstrap-icons.css" rel="stylesheet" type="text/css"/>
<!--        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
        <script src="<?= SYSTEM_PATH ?>assets/js/cdn.jsdelivr.net_npm_chart.js" type="text/javascript"></script>
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-headncpa flex-md-nowrap p-0 shadow">

            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#"><img class="mb-2 img-fluid" src="<?= SYSTEM_PATH ?>assets/images/logo.png" alt="ME LOGO" width="30">  EC of BAS</a>

            <?php
            $EMPID = $_SESSION['EMPID'];
            $db = dbConn();
            $sql = "SELECT `ProfilePic` FROM `tbl_employee` WHERE EmpID = '$EMPID'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">                     
                    <a class="nav-link px-3 text-white"> <img class="border border-success rounded-circle" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $row['ProfilePic']; ?>" height="50">  ' <?= $_SESSION['NAMEINITIALS'] ?> '  is Log-on     >>     </a>
                </div>
            </div>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3 text-white" href="<?= SYSTEM_PATH ?>logout.php"><strong>Sign out</strong></a>
                </div>
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">