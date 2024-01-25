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
                    unset($_SESSION['status']); }

                    if(isset($_GET['id'])){
                        //redirect to dashboard

                    $id = $_GET['id'];
                    $deleteUser = "DELETE FROM  `users` WHERE id = $id";
                    $deleteUserRun = mysqli_query($con, $deleteUser);
    
                    if ($deleteUserRun === TRUE) {
                        $_SESSION['status'] = "User is Deleted Succesfully!";
                        header("Location: ../userList.php");
                    } else {
                        $_SESSION['status'] = "Can't Delete the User, try again.";
                        header("Location: ../userList.php");
                    } 
                        
                    } else {
    
                    $_SESSION['status']= "ID is not provided.";
                        header("Location: ../userList.php");
                }
            ?>
                    <?php include('../includes/adminNavbar.php'); ?>

            </div>
        </div>
    </div>

</div>

<?php include('../includes/footer.php'); ?>