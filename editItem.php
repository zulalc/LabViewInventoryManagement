<?php
include('includes/authentication.php');
$page_title = "Dashboard Page";
include('includes/header.php');
include('includes/navbar.php');
include('database/dbCon.php');

?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            <?php 
                if(isset($_SESSION['status'])){
                    ?>
                    <div class="alert alert-success">
                    <h5> <?= $_SESSION['status']; ?></h5>
                    </div>
                    <?php 
                    unset($_SESSION['status']);
                }

                include('includes/roleNav.php');

                if (isset($_GET['itid']) && isset($_POST['editItemButton'])) {
                    $itid = $_GET['itid'];
                    $itemname = $_POST['itemname'];
                    $costprice = $_POST['costprice'];
                    $sellprice = $_POST['sellprice'];
                    $brand = $_POST['brand'];
                    $laboratory = $_POST['laboratory'];
                    $quantity =$_POST['quantity'];
                    echo $laboratory;

                    $updateI = "UPDATE `items` SET 
                    `itemname` = '$itemname',
                    `costprice` = '$costprice',
                    `sellprice` = '$sellprice',
                    `brand` = '$brand',
                    `labid` = '$laboratory',
                    `quantity` = '$quantity'
                    WHERE itid = $itid";
                    $updateIRun = mysqli_query($con, $updateI);
                
                    if ($updateIRun === TRUE) {
                        $_SESSION['status'] = "Item is Updated Succesfully!";
                        header("Location: inventoryList.php");
                    } else {
                        $_SESSION['status'] = "Can't Update the Item, try again.";
                        header("Location: inventoryList.php");
                    }
                } else {
                    $_SESSION['status'] = "Something Went Wrong.";
                        header("Location: inventoryList.php");
                }
        ?>