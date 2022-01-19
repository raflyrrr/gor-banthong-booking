<?php
$db_connection = mysqli_connect("127.0.0.1", "root","", "gorbanthong");
session_start();
if(empty($_SESSION['username'])){
	header("location: login.php");
}elseif(empty($_SESSION['date'])||empty($_SESSION['field'])||empty($_SESSION['duration'])||empty($_SESSION['price'])||empty($_SESSION['start_time'])){
    header("location: home.php");
}

$username = $_SESSION['username'];
$date=$_SESSION['date'];
$field=$_SESSION['field'];
$duration = $_SESSION["duration"];
$price = $_SESSION["price"];
$start_time = $_SESSION["start_time"];
$end_time = $start_time+$duration;

echo $price;

$query = " insert into booking (tgl,start,end,duration,username,field,price) values 
            ('$date',$start_time,$end_time,$duration,'$username','$field',$price);";
$query_run = mysqli_query($db_connection,$query);
if($query_run){
    unset($_SESSION['date']);
    unset($_SESSION['field']);
    unset($_SESSION["duration"]);
    unset($_SESSION["price"]);
    unset($_SESSION["start_time"]);
    
    header("location: booking.php");
}else{
    unset($_SESSION['date']);
    unset($_SESSION['field']);
    unset($_SESSION["duration"]);
    unset($_SESSION["price"]);
    unset($_SESSION["start_time"]);

    echo 'Booking failed please try again!';
}
