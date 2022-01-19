<?php
$db_connection = mysqli_connect("127.0.0.1", "root", "", "gorbanthong");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - GOR BANTHONG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="bg-overlay-login">
        <div class="container">
            <div class="row">
                <div class="col-md-6 centered-courts">
                    <h2>Login</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="box-court">
        <div class="c-header-court">
            <h2>Login to book</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="login" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>

                        <p>Dont have account? <a href="signup">Register</a> here</p>

                        <button type="submit" name="login" class="btn btn-success">
                            <font>Login</font>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    


    <?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "select password from customer where username = '$username'";
        $query_run = mysqli_query($db_connection, $query);
        $num_rows = mysqli_num_rows($query_run);
        if ($num_rows > 0) {
            $data = mysqli_fetch_assoc($query_run);
            if (password_verify($password, $data['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                header("location:home");
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">
                Wrong password
            </div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-3" role="alert">
            Wrong username
        </div>';
        }
    }

    ?>
<?php include('footer.php') ?>
</body>

</html>