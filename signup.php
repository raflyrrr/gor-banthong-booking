<?php
$db_connection = mysqli_connect("127.0.0.1", "root", "", "gorbanthong");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - GOR BANTHONG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="bg-overlay-register">
        <div class="container">
            <div class="row">
                <div class="col-md-6 centered-courts">
                    <h2>Register</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="box-court">
        <div class="c-header-court">
            <h2>Register to book</h2>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="signup" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>

                        <div class="form-group">
                            <input type="tel" class="form-control" name="phonenum" placeholder="Phone Number" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="repeatpass" placeholder="Confirm Password" required>
                        </div>

                        <p>
                            Have account? <a href="login"> Login</a> here
                        </p>


                        <button type="Sign Up" name="signup" class="btn btn-success">
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>



    <?php
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $phonenum = $_POST['phonenum'];
        $password = $_POST['password'];
        $repeatpass = $_POST['repeatpass'];
        if ($repeatpass == $password) {
            $query = "select * from customer where username = '$username'";
            $query_run = mysqli_query($db_connection, $query);
            $num_rows = mysqli_num_rows($query_run);
            if (!($num_rows > 0)) {
                $query = "select * from customer where phonenum = '$phonenum';";
                $query_run = mysqli_query($db_connection, $query);
                $num_rows = mysqli_num_rows($query_run);
                if (!($num_rows > 0)) {
                    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                    $query = "insert into customer (name,username,phonenum,password) values ('$name','$username','$phonenum','$hash_pass')";
                    $query_run = mysqli_query($db_connection, $query);
                    if ($query_run) {
                        echo '
                                <div class="alert alert-success mt-3" role="alert">
                                    Registration success!
                                    Silahkan <a href="login" class="alert-link">Login</a>
                                </div>
                                ';
                    } else {
                        echo '
                                <div class="alert alert-danger mt-3" role="alert">
                                    Something went wrong, try again!
                                </div>
                                ';
                    }
                } else {
                    echo '
                            <div class="alert alert-danger mt-3" role="alert">
                            The phone number is already in use, use another phone number
                            </div>
                            ';
                }
            } else {
                echo '
                        <div class="alert alert-danger mt-3" role="alert">
                        Username already used, use another username
                        </div>
                        ';
            }
        } else {
            echo
            '<div class="alert alert-danger mt-3" role="alert">
            Password does not match, please check your password
                    </div>';
        }
    }
    ?>
    <?php include('footer.php') ?>

</body>

</html>