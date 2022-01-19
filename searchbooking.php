<?php
$db_connection = mysqli_connect("127.0.0.1", "root", "", "gorbanthong");

session_start();
if (empty($_SESSION['username'])) {
    header("location: login");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking - GOR BANTHONG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include('navbar.php') ?>
    <div class="bg-overlay-court">
        <div class="container">
            <div class="row">
                <div class="col-md-6 centered-courts">
                    <h2>Search booking</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php
        $date = $_GET['date'];
        $field = $_GET['field'];
        $time = strtotime($date);
        $now = date('Y-m-d');
        $newformat = date('l\, F jS Y', $time);
        $day = floor(($time - time()) / 86400);
        if ($day + 1 < 0 || $day + 1 > 7) {
            header("location:home");
        } else {
            echo '<div class="mt-5 mb-1">';
            echo '<h1><font color="black">Search result</font></h1>';

            echo '
        <div class = row style="max-width:55%">
            <div class="col-md-6 border-right">
            <p  style="display:inline;"><font color="black">' . $newformat . '</font></p>
            </div>
            <div class="col-md-6">
            <p class = "ml-2 mt-2" style="display:inline;"><font color="black">' . $field . '</font></p>
            </div>
        </div>';


            echo '<h4 class = "mt-4 mb-3"><font color="black">Available time</font></h4>';
            echo '<div class="container row mt-1" style="max-width:100%;">';
            //echo $date;
            for ($x = 7; $x <= 23; $x++) {
                $available = true;
                $query = "select * from booking where tgl = '$date' and field='$field';";
                $query_run = mysqli_query($db_connection, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {
                    if ($row['start'] <= $x && $x < $row['end']) {
                        $available = false;
                    }
                }

                if ($available) {
                    echo '
                <div class="card  mr-4 mb-2 " style="width:120px;">
                    <div class="card-body">
                        <h5 class="card-title mt-2 text-center">' . $x . '.00 - ' . ($x + 1) . '.00</h5>
                    </div>
                </div>';
                } else {
                    echo '<div class="card mr-4 mb-2 bg-secondary" style="width:120px;">
                        <div class="card-body dark">
                            <h5 class="card-title mt-2 text-center">' . $x . '.00 - ' . ($x + 1) . '.00</h5>
                        </div>
                    </div>';
                }
            }
        ?>
    </div>
    <h4 class="mt-3">
        Choose time
    </h4>
    <div class="mt-3 mb-1" style="max-width: 60%">
        <form method="post">
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="number" min=7 max=23 name="start_time" class="form-control" placeholder="Start time" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-8">
                    <input type="number" min=1 max=5 name="duration" class="form-control" placeholder="Duration" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success mb-2" name="book">
                        Book now
                    </button>
                </div>
            </div>
        </form>
    </div>

<?php
        } ?>

<!-- modal -->
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Order Summary</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $start_time; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->



<?php
if (isset($_POST['book'])) {
    $start_time = $_POST["start_time"];
    $duration = $_POST["duration"];
    $end_time = $start_time + $duration;
    $conflict = false;
    $query = "select * from booking where tgl = '$date' and field='$field';";
    $query_run = mysqli_query($db_connection, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        if (($start_time <= $row['start'] && $end_time >= $row['end']) || ($start_time >= $row['start'] && $start_time < $row['end']) || ($end_time > $row['start'] && $end_time <= $row['end'])) {
            $conflict = true;
        }
    }
    if ($conflict) {
        echo '
                <div class="alert alert-danger mt-3 mb-1" style="max-width: 80%" role="alert">
                <h5 class="alert-heading">Time not available</h5>
                Choose available time
                </div>
                ';
    } else {
        //echo '<script>$("#exampleModal").modal()</script>';
?>
        <h4>Booking detail</h4>
        <div class="form-detail">
            <form method="post" class="mt-3 mb-1" style="max-width: 60%">
                <div class="form-group-detail row">
                    <?php
                    $username = $_SESSION["username"];
                    $query = "select name from customer where username = '$username'";
                    $query_run = mysqli_query($db_connection, $query);
                    $row = mysqli_fetch_assoc($query_run);
                    $name = $row['name']
                    ?>
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" value=": <?php echo $name; ?>">
                    </div>
                </div>
                <div class="form-group-detail row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="inputPassword" value=": <?php echo $newformat; ?>">
                    </div>
                </div>
                <div class="form-group-detail row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Court Name</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="inputPassword" value=": <?php echo $field; ?>">
                    </div>
                </div>
                <div class="form-group-detail row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Start time</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="inputPassword" value=": <?php echo $start_time . '.00 - ' . $end_time . '.00'; ?> WIB">
                    </div>
                </div>
                <div class="form-group-detail row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Duration</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext " id="inputPassword" value=": <?php echo $duration . ' hour(s)'; ?>">
                    </div>
                </div>
                <div class="form-group-detail row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Total Harga</label>
                    <div class="col-sm-10">
                        <?php
                        $queryHarga = "select * from field where harga and fieldnum = '$field';";
                        $query_run = mysqli_query($db_connection, $queryHarga);
                        while ($row = mysqli_fetch_assoc($query_run)) {


                            $price = 0;
                            $price_count = $start_time;
                            $day_num = date('N', $time);
                            for ($x = 0; $x < $duration; $x++) {
                                if ($price_count + 1 >= 8 && $price_count < 14) {
                                    if ($field) {
                                        if ($day_num >= 1) {
                                            $price = $price + $row['harga'];
                                        }
                                    }
                                } else {
                                    if ($field) {
                                        if ($day_num >= 1) {
                                            $price = $price + $row['hargamalam'];
                                        }
                                    }
                                }
                                $price_count = $price_count + 1;
                            }
                        }
                        ?>
                        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="inputPassword" value=": Rp. <?php echo number_format($price) ?>">
                    </div>
                </div>
                <div class="form-group-detail row">
                    <div class="col-sm-10">
                        <?php
                        $_SESSION['date'] = $date;
                        $_SESSION['field'] = $field;
                        $_SESSION["duration"] = $duration;
                        $_SESSION["price"] = $price;
                        $_SESSION["start_time"] = $start_time;
                        ?>
                        <a href="book" class="btn btn-success my-3">Confirm</a>
                    </div>
                </div>

            </form>
        </div>
<?php
        if (isset($_POST['confirm'])) {
            $query = "  insert into booking (tgl,start,end,duration,username,fieldnum) values 
                                ('$date',$start_time,$end_time,$duration,$username,'$field');";
            $query_run = mysqli_query($db_connection, $query);
            if ($query_run) {
                echo 'Sukses booking';
            } else {
                echo "Terjadi beberapa kesalahan, coba lagi!";
            }
        }
    }
}
?>
<hr>
</body>
<script src="./js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</html>