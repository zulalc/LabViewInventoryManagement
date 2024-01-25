<?php
include('database/dbCon.php');
$id = $_GET['id'];
$sql="SELECT * from  items where itid=$id";
$sqlRun = mysqli_query($con, $sql);
$item = array();
if($sqlRun->num_rows > 0){
    while($row = mysqli_fetch_assoc($sqlRun)){
    $item['ID'] = $row['itid'];
    $item['Name'] = $row['itemname'];
    $item['Price'] = $row['sellprice'];
    $item['Brand'] = $row['brand'];

    $labid = $row['labid'];
    $getLab = "SELECT fullname FROM laboratories WHERE labid='$labid'";
    $row2 = mysqli_fetch_assoc(mysqli_query($con, $getLab));
    $item['Laboratory'] = $row2['fullname'];
    $item['Quantity'] = $row['quantity'];
    }
}

echo json_encode($item);
?>