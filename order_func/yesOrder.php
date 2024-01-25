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
                    unset($_SESSION['status']);

                    
                }
                
                if(!isset($_GET['orderid'])){
                    //redirect to dashboard
                    $_SESSION['status']= "ID is not provided.";
                    header("Location: ../orderList.php");
                }

                $orderid = $_GET['orderid'];
                    ?>
                    <?php include('../includes/roleNav.php'); ?>
                    <div class="form-group">
                    <div class="alert alert-danger" role="alert">
                        You are confirming this order. Are you sure?
                            </div>
                            <?php
                            echo " <a class='btn btn-success' href='yesOrderConf.php?orderid=" .$orderid ."'> Confirm</a>"; ?>
                            <a href="../orderList.php" class="btn btn-secondary" role="button" aria-pressed="true">Cancel</a>
                            </div>

            </div>
        </div>
    </div>

</div>