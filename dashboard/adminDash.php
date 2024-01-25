<?php
include('../includes/authentication.php');
$page_title = "Admin Dashboard Page";
include('../includes/header.php');
include('../includes/navbar.php');
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
            ?>
                    <?php include('../includes/roleNav.php') ?>

            </div>
        </div>
    </div>

</div>

<?php include('../includes/footer.php'); ?>