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

                    if (isset($_GET['id']) && isset($_POST['editUserButton'])) {
                        $id = $_GET['id'];
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $role = $_POST['role'];
                      
                        $updateUser = "UPDATE `users` SET 
                        `firstName` = '$firstName',
                        `lastName` = '$lastName',
                        `phone` = '$phone',
                        `email` = '$email',
                        `role` = '$role'
                        WHERE id = $id";
                        $updateUserRun = mysqli_query($con, $updateUser);
                    
                        if ($updateUserRun === TRUE) {
                            $_SESSION['status'] = "User is Updated Succesfully!";
                            header("Location: ../userList.php");
                        } else {
                            $_SESSION['status'] = "Can't Update the User, try again.";
                            header("Location: ../userList.php");
                        }
                    } else {
                        $_SESSION['status'] = "Something Went Wrong.";
                            header("Location: ../userList.php");
                    }
            ?>
                <?php include('../includes/adminNavbar.php'); ?>

            </div>
        </div>
    </div>

</div>

<?php include('../includes/footer.php'); ?>