<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index">GOR SAHABAT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="fas fa-bars"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Informasi Lapangan
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="field">Lihat Lapangan</a>
          <a class="dropdown-item" href="home">Booking Lapangan</a>
        </div>
      </li> -->
      </ul>
      <ul class="navbar-nav ml-auto">

        <?php


        if (isset($_SESSION['username'])) :  $username = $_SESSION["username"];
          $query = "select name from customer where username = '$username'";
          $query_run = mysqli_query($db_connection, $query);
          $row = mysqli_fetch_assoc($query_run);
          $name = $row['name']; ?>


          <div class="nav-text">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="field">COURTS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="home">BOOKING</a>
              </li>
              <li class="nav-item dropdown"> <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons" style="font-size:30px">account_circle</i>
                </a>
                <div class="dropdown-menu">
                  <p class="dropdown-item"><?php echo $row['name']; ?>  </p>
                  <hr>
                  <a class="dropdown-item" href="booking">View booking</a>
                  <a class="dropdown-item" href="history">Booking history</a>
                  <a class="dropdown-item" href="logout">Log Out</a>
                </div>
              </li>
            </ul>
          </div>
        <?php

        else : ?>
          <div class="nav-text">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="field">COURTS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signup">REGISTER</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login">LOGIN</a>
              </li>
            </ul>
          </div>
        <?php
        endif;

        ?>
      </ul>
    </div>
  </div>
</nav>