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
                    $getQuant = "SELECT quantity, itid FROM `orders` WHERE orderid = $orderid";
                    $row = mysqli_fetch_assoc(mysqli_query($con, $getQuant));
                    $quantity =  $row['quantity'];
                    $itid = $row['itid'];
                    $updateI = "UPDATE items SET quantity= quantity + $quantity WHERE itid=$itid";
                    $updateIRun = mysqli_query($con, $updateI);
                    $deleteO = "UPDATE orders SET orderStatus = 2 WHERE orderid=$orderid";
                    $deleteORun = mysqli_query($con, $deleteO);
    
                    if ($deleteORun === TRUE && $updateIRun === TRUE ) {
                        $_SESSION['status'] = "Order is Denied Succesfully!";
                        header("Location: ../orderList.php");
                    } else {
                        $_SESSION['status'] = "Can't Deny the Order, try again.";
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