<?php
include('../includes/authentication.php');
$page_title = "Admin Dashboard Page";
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
                
                if(!isset($_GET['id'])){
                    //redirect to dashboard
                    $_SESSION['status']= "ID is not provided.";
                    header("Location: ../userList.php");
                }

                $id = $_GET['id'];
                    ?>
                    <?php include('../includes/adminNavbar.php'); ?>
                    <div class="form-group">
                    <div class="alert alert-danger" role="alert">
                        WARNING!! Deleted information cannot be recovered.
                            </div>
                            <?php
                            echo " <a class='btn btn-danger' href='../deleteUserConfirm.php?id=" .$id ."'> Delete</a>"; ?>
                            <a href="../userList.php" class="btn btn-secondary" role="button" aria-pressed="true">Cancel</a>
                            </div>

            </div>
        </div>
    </div>

</div>