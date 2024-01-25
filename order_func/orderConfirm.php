<?php
include('../includes/authentication.php');
$page_title = "Dashboard Page";
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
                    include('../includes/roleNav.php');

                    if (isset($_GET['itid']) && isset($_POST['orderButton'])) {
                        $itid = $_GET['itid'];
                        $quantity = $_POST['quantity'];
                        $descr = strval($_POST['descr']);
                      
                        $orderItem = "UPDATE items SET quantity= quantity - $quantity WHERE itid=$itid";
                        $orderItemRun = mysqli_query($con, $orderItem);

                        $lab = "SELECT labid,sellprice
                        FROM items WHERE itid = $itid";
                        $data = mysqli_fetch_array(mysqli_query($con, $lab));
                        $labid = $data['labid'];
                        $id = implode(" ", $_SESSION['userID']);

                        $cost = intval($data['sellprice'])*intval($quantity);

                        if ($orderItemRun === TRUE) {
                            $order = "INSERT INTO `orders`(`itid`, `labid`, `userid`,
                             `quantity`, `cost`, `descr`) 
                            VALUES
                             ($itid,$labid,$id,
                             $quantity,$cost,'$descr')";

                            $insertOrder = mysqli_query($con, $order);
                    
                            if ($insertOrder) {
                                $_SESSION['status']= "Item is Ordered Succesfully!";
                            header("Location: ../inventoryList.php");
                            } else {
                                $_SESSION['status'] = "Something Went Wrong.";
                                header("Location: ../inventoryList.php");
                            }
                        } else {
                            $_SESSION['status'] = "Can't Order the Item, try again.";
                            header("Location: ../inventoryList.php");
                        }
                    } else {
                        $_SESSION['status'] = "Something Went Wrong.";
                            header("Location: ../inventoryList.php");
                    }
                    
            ?>

            </div>
        </div>
    </div>

</div>

<?php include('../includes/footer.php'); ?>