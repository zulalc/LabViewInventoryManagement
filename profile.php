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
            ?>
                        <?php 
                        if(isset($_SESSION['userID'])){
                         $userid= implode($_SESSION['userID']);
                         $getU = "SELECT * FROM `users` WHERE id= $userid";
                         $getURun = mysqli_query($con, $getU);

                        if($getURun->num_rows > 0){
                            $data = mysqli_fetch_array($getURun);
                        } else {
                                $_SESSION['status'] = "Something Went Wrong.";
                                header("Location: inventoryList.php");
                        } ?>
                        <div class="card-shadow">
                    <div class="card-header">
                        <h5>Profile Settings</h5>
                    </div>
                    <div class="card-body">
                        <form action="editProfile.php?id=<?= $userid?>" method="POST">
                            <div class="form-group mb-3">
                                <label for="">First Name: </label>
                                <input type="text" name="firstName" value ="<?= $data['firstName']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Last Name: </label>
                                <input type="" name="lastName" value ="<?= $data['lastName']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Email: </label>
                                <input type="text" name="email" value ="<?= $data['email']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Phone: </label>
                                <input type="text" name="phone" value ="<?= $data['phone']?>" class="form-control">
                            </div>
                            <?php if($data['role'] == "User") { ?> 
                                <div class="form-select mb-3">
                                <label for="">User Type:</label>
                                <select  name="userType" class="form-control">
                                    <option value="regular"> Regular </option>
                                    <option value="manager"> Manager </option>
                                    <option value="student"> Student </option>
                                </select>
                            </div>

                            <?php } } else {
                                $_SESSION['status'] = "Something Went Wrong.";
                                header("Location: inventoryList.php");
                                }?>
                            <div class="form-group">
                                <input type="submit" name="editProfileBtn" value="Confirm" class="btn btn-primary"> </input>
                                <a href="inventoryList.php" class="btn btn-secondary" role="button" aria-pressed="true">Cancel</a>
                            </div>
                        </form>
                </div>      
            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php');?>