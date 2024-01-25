<?php
include('../includes/authentication.php');
$page_title = "Dashboard Page";
include('../includes/header.php');
include('../includes/navbar.php');
include('../database/dbCon.php');
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
                    unset($_SESSION['status']); }

                    if(isset($_GET['orderid'])){
                        //redirect to dashboard

                    $orderid = $_GET['orderid'];

                    $getQuant = "SELECT itid, labid, userid, quantity, cost FROM `orders` WHERE orderid = $orderid";
                    $row = mysqli_fetch_assoc(mysqli_query($con, $getQuant));
                    $itid =  $row['itid'];
                    $labid =  $row['labid'];
                    $userid=  $row['userid'];
                    $quantity =  $row['quantity'];
                    $cost = $row['cost'];

                    $updateO = "UPDATE orders SET orderStatus = 1 WHERE orderid=$orderid";
                    $updateORun = mysqli_query($con, $updateO);

                    $insertP = "INSERT INTO `purchases`( `itid`, `labid`, `userid`, `quantity`, `totalcost`) 
                    VALUES 
                    ('$itid','$labid','$userid','$quantity','$cost')";
                    $insertPRun = mysqli_query($con, $insertP);
    
                    if ($updateORun === TRUE && $insertPRun === TRUE ) {
                        $_SESSION['status'] = "Order is Confirmed Succesfully!";
                        header("Location: ../orderList.php");
                    } else {
                        $_SESSION['status'] = "Can't Confirm the Order, try again.";
                        header("Location: ../orderList.php");
                    } 
                        
                    } else {
    
                    $_SESSION['status']= "ID is not provided.";
                        header("Location: ../orderList.php");
                }
            ?>
                    <?php include('../includes/roleNavbar.php'); ?>

            </div>
        </div>
    </div>

</div>

<?php include('../includes/footer.php'); ?>