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

                    if (isset($_POST['addUserButton'])) {
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $role = $_POST['role'];
                        $password =$_POST['password'];
                        $verifyStatus = 1;
                        //$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
                        $verifyToken = md5(rand()); //random number
                      
                        //check email exists, SQL query
                        $checkEmail = "SELECT email FROM Users WHERE email='$email' LIMIT 1";
                        $checkEmailRun = mysqli_query($con, $checkEmail);
                    
                        if (mysqli_num_rows($checkEmailRun) > 0) {
                            $_SESSION['status'] = "Email is Already Registered";
                            header("Location: ../adminDashboard.php");
                        } else {
                            //Insert user into database
                            $insertUser = "INSERT INTO users (firstName,lastName,phone,email,password,role,verifyToken,verifyStatus) VALUES ('$firstName','$lastName','$phone','$email','$password','$role','$verifyToken','$verifyStatus')";
                            $inserUserRun = mysqli_query($con, $insertUser);
                    
                            if ($inserUserRun) {
                                $_SESSION['status']= "User is Added Succesfully!";
                            header("Location: ../userList.php");
                            } else {
                                $_SESSION['status'] = "Something Went Wrong.";
                                header("Location: ../adminDashboard.php");
                            }
                        }
                    }
            ?>
                    <?php include('../includes/roleNav.php'); ?>

            </div>
        </div>
    </div>

</div>

<?php include('../includes/footer.php'); ?>