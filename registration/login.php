<?php 
session_start();

if (isset($_SESSION['authenticated'])){
    $_SESSION['status'] = "You are already logged in.";
    if($_SESSION["role"] == "admin") {
        header('Location: ../dashboard/adminDash.php');}
       else if($_SESSION["role"] == "staff") {
        header('Location: ../dashboard/staffDash.php');
       } else if ($_SESSION["role"] == "user") {
        header('Location: ../dashboard/userDash.php');
       }
    
    exit(0);
} 
$page_title = "Login Page";
include('../includes/header.php');
include('../includes/navbar.php');?>


<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
                <div class="card-shadow">
                    <div class="card-header">
                        <h5>Login Page</h5>
                    </div>
                    <div class="card-body">
                        <form action="loginCode.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">E-mail Address</label>
                                <input type="text" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="loginButton" value="Login" class="btn btn-primary"></input>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php include('../includes/footer.php'); ?>