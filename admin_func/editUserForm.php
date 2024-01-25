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
                $selectUser = "SELECT * FROM  `users` WHERE id = $id";
                $selectUserRun = mysqli_query($con, $selectUser);

                if (mysqli_num_rows($selectUserRun) < 0) {
                    $_SESSION['status'] = "User does not exist.";
                    header("Location: ../userList.php");
                } 

                $data = mysqli_fetch_array($selectUserRun);

            ?>
                    <?php include('../includes/adminNavbar.php'); ?>

                    <div class="card-shadow">
                    <div class="card-header">
                        <h5>User Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="editUser.php?id=<?= $id?>" method="POST">
                            <div class="form-group mb-3">
                                <label for="">First Name</label>
                                <input type="text" name="firstName" value ="<?= $data['firstName']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Last Name</label>
                                <input type="text" name="lastName" value ="<?= $data['lastName']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" value ="<?= $data['phone']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">E-mail Address</label>
                                <input type="text" name="email" value ="<?= $data['email']?>" class="form-control">
                            </div>

                            <div class="form-select mb-3">
                                <label for="">Role:</label>

                                <select  name="role" class="form-control">
                                    <option value="administrator"> Administrator </option>
                                    <option value="staff"> Staff </option>
                                    <option value="user"> User </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="editUserButton" value="Confirm" class="btn btn-primary"> </input>
                                <a href="../userList.php" class="btn btn-secondary" role="button" aria-pressed="true">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>