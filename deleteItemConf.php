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
                    unset($_SESSION['status']); }

                    if(isset($_GET['itid'])){
                        //redirect to dashboard

                    $itid = $_GET['itid'];
                    $deleteOrd= "DELETE FROM `orders` WHERE itid = $itid";
                    $deleteORun = mysqli_query($con, $deleteOrd);
                    $deletePurc= "DELETE FROM `purchases` WHERE itid = $itid";
                    $deletePRun = mysqli_query($con, $deletePurc);
                    
                    if ($deleteORun === TRUE && $deletePRun===TRUE) {
                        $deleteItem = "DELETE FROM `items` WHERE itid = $itid";
                        $deleteItemRun = mysqli_query($con, $deleteItem);
                        if($deleteItemRun===TRUE){
                        $_SESSION['status'] = "Item is Deleted Succesfully!";
                        header("Location: inventoryList.php");}
                        else{
                            $_SESSION['status'] = "Can't Delete the Item.";
                            header("Location: inventoryList.php");  ;
                        }
                    } else {
                        $_SESSION['status'] = "Can't Delete the Order, try again.";
                        header("Location: inventoryList.php");
                    } 
                        
                    } else {
    
                    $_SESSION['status']= "ID is not provided.";
                        header("Location: inventoryList.php");
                }
            ?>
                    <?php include('includes/roleNav.php'); ?>

            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>