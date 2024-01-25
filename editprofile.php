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
            ob_start();
                if(isset($_SESSION['status'])){
                    ?>
                    <div class="alert alert-success">
                    <h5> <?= $_SESSION['status']; ?></h5>
                    </div>
                    <?php 
                    unset($_SESSION['status']);
                }
                include('includes/roleNav.php');
                
                if (isset($_GET['id']) && isset($_POST['editProfileBtn'])) {
                    $id = $_GET['id'];
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];

                    if ($_SESSION["role"] == "user") {
                    $userType =$_POST['userType'];
                    $updateUser = "UPDATE `users` SET 
                    `firstName` = '$firstName',
                    `lastName` = '$lastName',
                    `phone` = '$phone',
                    `email` = '$email',
                    `userType` = '$userType'
                    WHERE `id` = $id";
                    } else {
                       $updateUser = "UPDATE `users` SET 
                       `firstName` = '$firstName',
                       `lastName` = '$lastName',
                       `phone` = '$phone',
                       `email` = '$email'
                       WHERE `id` = $id"; 
                    }
                    try {
                    $updateUserRun = mysqli_query($con, $updateUser);
                    } catch (mysqli_sql_exception $e) { 
                    var_dump($e);
                    exit; 
                    }
                    if ($updateUserRun === TRUE) {
                        $_SESSION['status'] = "Profile is Updated Succesfully!";
                        header("Location: profile.php");
                    } else {
                        $_SESSION['status'] = "Can't Update the Profile, try again.";
                        header("Location: profile.php");
                    }
                } else {
                    $_SESSION['status'] = "Something Went Wrong.";
                        header("Location: profile.php");
                }
            ?>
            
            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>