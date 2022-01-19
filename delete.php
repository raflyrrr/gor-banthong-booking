<?php
include 'dbConnect.php';
$transnum = $_GET['transnum'];
$delete="DELETE FROM booking where transnum=$transnum";
mysqli_query($db_connection,$delete);
header("location:adminTransaction.php");
?>