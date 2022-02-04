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
    <title>Booking - GOR SAHABAT</title>

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
                    <h2>View Booking</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-1">
        <h3>Ongoing Booking</h3>
    </div>

    <div class="mb-5">

        <?php
        $username = $_SESSION["username"];
        $now = date('Y-m-d');
        $query = "select * from booking INNER join field on booking.field=field.fieldnum where username = '$username' and status = 'Waiting for Confirmation' order by datecreated desc ";
        $query_run = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            $transnum = $row['transnum'];
            $tgl = $row['tgl'];
            $price = $row['price'];
            $status = $row['status'];
            $start_time = $row['start'];
            $duration = $row['duration'];
            $end_time = $start_time + $duration;
            $datecreated = $row['datecreated'];
            $field = $row['field'];
            $gambar = $row['gambar'];

            $created = strtotime($datecreated);
            $createdformat = date('d M, h.i a', $created);

            $date = strtotime($tgl);
            $now = date('Y-m-d');
            $newformat = date('l\, F jS Y', $date);

        ?>
            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Batalkan pemesanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin?<br>
                            Anda tidak dapat membatalkan tindakan ini
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <a href="cancelbooking?transnum=<?php echo $transnum ?>"><button type="button" class="btn btn-primary">Yes</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container card shadow-sm mt-4 mb-1" style="width: 1100px; max-width: 100%;">
                <div class="row">
                    <div class="col-md-4 px-0">
                        <div class="card-body card-view-img">
                            <img src="./assets/img/fieldimages/<?php echo $gambar ?>" alt="" width="300px">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-view-content">
                            <h4> <?php echo $field ?> </h4>
                            <p class="text-muted"><?php echo $status ?></p>
                            <p>Rp. <?php echo number_format($price) ?> </p>
                            <a href="bookingdetail?transnum=<?php echo $transnum; ?>" class="card-link"><i class="material-icons">more_horiz</i> Details</a>
                            <a href="" class="card-link text-danger" data-toggle="modal" data-target="#exampleModal"> Cancel booking</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php
        }
?>
</div>
<hr>
<?php include('footer.php') ?>
</body>

</html>