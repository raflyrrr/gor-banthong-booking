<?php
$db_connection = mysqli_connect("127.0.0.1", "root", "", "gorbanthong");
session_start();
if (empty($_SESSION['username'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking History - GOR BANTHONG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include('navbar.php') ?>
    <div class="bg-overlay-court">
        <div class="container">
            <div class="row">
                <div class="col-md-6 centered-courts">
                    <h2>Booking History</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-1">
        <h3>History court booking</h3>
    </div>

    <div class="mb-5">

        <?php
        $username = $_SESSION["username"];
        $now = date('Y-m-d');
        $query = "select * from booking where username = '$username' and status = 'Accepted' order by datecreated desc";
        $query_run = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            $transnum = $row['transnum'];
            $tgl = $row['tgl'];
            $price = $row['price'];
            $status = $row['status'];
            $start_time = $row['start'];
            $duration = $row['duration'];
            $end_time = $start_time + $duration;

            $date = strtotime($tgl);
            $now = date('Y-m-d');
            $newformat = date('l\, F jS Y', $date);

        ?>
            <div class="container card shadow-sm mt-3 mb-1" style="width: 1100px; max-width: 100%">
                <div class="card-body">
                    <div class="row">
                        <div class="col ">
                            <h4> <?php echo $newformat ?> </h4>
                            <p class="text-muted"><?php echo $status ?></p>
                            <!-- <h6><?php echo $start_time . '.00 - ' . $end_time . '.00' ?></h6> -->
                        </div>
                        <div class="col text-right">
                            <a href="bookingdetail?transnum=<?php echo $transnum; ?>" class="card-link"><i class="material-icons">more_horiz</i> Details</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
    <hr>
    <?php include('footer.php')?>
</body>

</html>