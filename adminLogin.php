<?php
include "dbConnect.php";

session_start();
if (!empty($_SESSION['inputAdmin'])) {
    header("location: adminHome");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GOR BANTHONG - Login</title>

    <!-- Custom fonts for this template-->
    <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">GOR BANTHONG</h1>
                                    </div>
                                    <form class="user" action="adminLogin" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Enter Username" name="inputAdmin">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Password" name="inputPassword">
                                        </div>
                                        <button type="submit" name="adminLogin" class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php
    if (isset($_POST['adminLogin'])) {
        $inputAdmin = $_POST['inputAdmin'];
        $inputPassword = $_POST['inputPassword'];
        echo $inputAdmin;
        $query = "select password from customer where username = '$inputAdmin' and role='admin'";
        $query_run = mysqli_query($db_connection, $query);
        $num_rows = mysqli_num_rows($query_run);
        if ($num_rows > 0) {
            $data = mysqli_fetch_assoc($query_run);
            if ($inputPassword == $data['password']) {
                session_start();
                $_SESSION['inputAdmin'] = $inputAdmin;
                header("location:adminHome");
            } else {
                echo  '<div class="alert alert-danger mt-3" role="alert">
                Password yang anda masukkan salah
            </div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-3" role="alert">
            User tidak ditemukan
        </div>';
        }
    }

    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./js/sb-admin-2.min.js"></script>

</body>

</html>