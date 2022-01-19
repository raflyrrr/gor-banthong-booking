<?php
include 'dbConnect.php';
$fieldnum = $_GET['fieldnum'];
$delete="DELETE FROM field where fieldnum='$fieldnum'";
mysqli_query($db_connection,$delete);
header("location:adminField.php");
?>