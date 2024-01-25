<?php
include('includes/authentication.php');
$page_title = "Dashboard Page";
include('includes/header.php');
include('includes/navbar.php');
include('database/dbCon.php');
require_once('phpqrcode/phpqrcode/qrlib.php');
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

                    
                    $path = 'qr_images/';
                    $qrcode = $path.time().".png";
                    $qrimage = time().".png";
                    

                    if (isset($_POST['addItemButton'])) {
                        $itemname = $_POST['itemname'];
                        $costprice = $_POST['costprice'];
                        $sellprice = $_POST['sellprice'];
                        $brand = $_POST['brand'];
                        $laboratory = $_POST['laboratory'];
                        $quantity = $_POST['quantity'];
                        //check item
                        $checkItem = "SELECT itemname FROM items WHERE itemname='$itemname' LIMIT 1";
                        $chechItemRun = mysqli_query($con, $checkItem);
                        


                        if (mysqli_num_rows($chechItemRun) > 0) {
                            $_SESSION['status'] = "Item is Already Registered";
                            if($_SESSION["role"] == "admin") {
                                header("Location: adminDash.php");
                            } else if ($_SESSION["role"] == "staff"){
                                header("Location: staffDash.php");
                            } else if ($_SESSION["role"] == "user"){
                                header("Location: userDash.php");
                            }
                        } else {
                            //Insert user into database
                            $insertItem = "INSERT INTO items (iQR,itemname,costprice,sellprice,brand,labid,quantity) VALUES ('$qrimage','$itemname','$costprice','$sellprice','$brand','$laboratory','$quantity')";
                            $insertItemRun = mysqli_query($con, $insertItem);
                    
                            if ($insertItemRun) {
                                $last_id = $con->insert_id;
                                QRcode :: png("$last_id", $qrcode, 'H', 4, 4); 
                                $_SESSION['status']= "Item is Added Succesfully!";
                                header("Location: inventoryList.php");
                            } else {
                                $_SESSION['status'] = "Something Went Wrong.";
                                header("Location: inventoryList.php");
                            }
                        }
                    }
            ?>
                    <?php include('includes/roleNav.php'); ?>

            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>