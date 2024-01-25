<?php
session_start();
$page_title = "Registration Page";
include('../includes/header.php');
include('../includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert"> 
                <?php 
                if(isset($_SESSION['status'])){
                    echo "<h4>".$_SESSION['status']."</h4>";
                    unset($_SESSION['status']);
                }
                ?>
                </div>
                <div class="card-shadow">
                    <div class="card-header">
                        <h5>Registration Page</h5>
                    </div>
                    <div class="card-body">
                        <form action="regForm.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">First Name</label>
                                <input type="text" name="firstName" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Last Name</label>
                                <input type="text" name="lastName" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">E-mail Address</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="form-select mb-3">
                                <label for="">Role:</label>

                                <select  name="role" class="form-control">
                                    <option value="admin"> Administrator </option>
                                    <option value="staff"> Staff </option>
                                    <option value="user"> User </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="reg_button" value="Register" class="btn btn-primary"> </input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>