<?php
$db_connection = mysqli_connect("127.0.0.1", "root", "", "gorbanthong");

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GOR SAHABAT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div class="bg-overlay">
        <?php include('navbar.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6 centered">
                    <h2>Book badminton courts in under 5 minutes</h2>
                    <h3>Now you can shop our sports products too!</h3>
                    <div class="btn-booking">
                        <a href="home" class="btn btn-primary">BOOK NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <div class="c-header">
                <div class="c-h1">
                    <h1>Here is how it works</h1>
                </div>
                <div class="c-h2">
                    <h3>Follow these 3 steps</h3>
                </div>
            </div>
            <div class="row content-row">
                <div class="col-md-4">
                    <i class="fas fa-search"></i>
                    <h3>Search</h3>
                    <p>Find your desirable court</p>
                </div>
                <div class="col-md-4">
                    <i class="far fa-calendar-check"></i>
                    <h3>Book</h3>
                    <p>Book the date and pay online</p>
                </div>
                <div class="col-md-4">
                    <i class="far fa-shuttlecock"></i>
                    <h3>Play</h3>
                    <p>Access your booked court by showing your payment receipt</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <hr>
    </div>
    <?php include('footer.php') ?>
    
</body>


</html>