<?php

error_reporting(E_ALL);
include "connect.php";
$get=$_GET['chkYesNo'];
$nameInput=$_GET['nameInput'];
$col = substr($nameInput, 0, 13);
$id = substr($nameInput, 14);
$sql = "UPDATE Box SET ";
$sql .=$col . "=" . "'" . $get . "'";
$sql .=" WHERE idBox = '" . $id . "' ";
$objQuery = mysqli_query($conn, $sql);
?>