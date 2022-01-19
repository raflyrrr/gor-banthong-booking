<?php
$db_connection = mysqli_connect("127.0.0.1", "root", "", "gorbanthong");
session_start();
if (empty($_SESSION['username'])) {
    header("location: login");
}
ob_start();
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
    <?php include('navbar.php'); ?>
    <div class="bg-overlay-booking">
        <div class="container">
            <div class="row">
                <div class="col-md-6 centered-courts">
                    <h2>Booking</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="box-court">
        <div class="c-header-court">
            <h2>Choose your court and book!</h2>
        </div>
        <div class="container">
            <form action="home" method="POST" class="form-inline">
                <div class="form-group mb-2">
                    <input type="date" class="form-control" name="date" required>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <div class="form-group">
                        <select name="field" class="form-control" required>
                            <?php $query = "select fieldnum from field;";
                            $query_run = mysqli_query($db_connection, $query);
                            while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                                <option value="<?php echo $row['fieldnum']; ?>"><?php echo $row['fieldnum'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mb-2" name="date_search">
                    Search
                </button>
            </form>
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
                                <div class="harga-book">
                                    <p>Morning : Rp. <?php echo number_format($row['harga']) ?></p>
                                    <p>Night : Rp. <?php echo number_format($row['hargamalam']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
    <div class="container">
        <hr>
    </div>
    <?php
    if (isset($_POST['date_search'])) {
        $field = $_POST['field'];
        $date = $_POST['date'];
        $time = strtotime($date);
        $now = date('Y-m-d');
        $newformat = date('l\, F jS Y', $time);

        $day = floor(($time - time()) / 86400);
        if ($day + 1 < 0 || $day + 1 > 7) {
            echo '
            <div class="alert alert-danger mt-3 mb-1" style="max-width: 50%" role="alert">
            <h5 class="alert-heading">Tanggal tidak tersedia</h5>
            Harap masukkan tanggal dalam 7 hari ke depan dari hari ini!
            </div>
            ';
        } else {
            header("location: searchbooking?date=" . $date . "&field=" . $field);
        }
        echo '</div>';
    }
    ?>
    <?php include('footer.php') ?>
</body>
</html>