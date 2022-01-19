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
    <title>GOR BANTHONG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

    <?php include('navbar.php'); ?>
    <div class="bg-overlay-court">
        <div class="container">
            <div class="row">
                <div class="col-md-6 centered-courts">
                    <h2>Courts</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="box-court">
        <div class="c-header-court">
            <h2>Choose your court</h2>
        </div>
        <div class="container">
            <div class="row">
                <?php $query = "select * from field;";
                $query_run = mysqli_query($db_connection, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {

                ?>
                    <div class="col-md-4">
                        <div class="card mb-3 card-field">
                            <img src="./assets/img/fieldimages/<?php echo $row['gambar'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5><?php echo $row['fieldnum'] ?></h5>
                                <div class="harga"> 
                                    <p>Morning : Rp. <?php echo number_format($row['harga']) ?></p>
                                    <p>Night : Rp. <?php echo number_format($row['hargamalam']) ?></p>
                                </div>
                                <a href="home" class="btn btn-success float-right" style="margin-top: 10px;">Book now</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container">
        <hr>
    </div> <?php include('footer.php') ?>
</body>

</html>