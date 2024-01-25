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
             
                if(!isset($_GET['itid'])){
                    //redirect to dashboard
                    $_SESSION['status']= "ID is not provided.";
                    header("Location: inventoryList.php");
                }

                $itid = $_GET['itid'];
                $getItem = "SELECT * FROM  `items` WHERE itid = $itid";
                $getItemRun = mysqli_query($con, $getItem);

                if (mysqli_num_rows($getItemRun) < 0) {
                    $_SESSION['status'] = "Item does not exist.";
                    header("Location: inventoryList.php");
                } 

                $data = mysqli_fetch_array($getItemRun);
                $labid = $data['labid'];
                $labname = mysqli_fetch_assoc(mysqli_query($con, "SELECT fullname FROM laboratories WHERE labid='$labid'"));

            ?>
                    <div class="card-shadow">
                    <div class="card-header">
                        <h5>Item Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="editItem.php?itid=<?= $itid?>" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Item Name</label>
                                <input type="text" name="itemname" value ="<?= $data['itemname']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Cost Price</label>
                                <input type="" name="costprice" value ="<?= $data['costprice']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Sell Price</label>
                                <input type="text" name="sellprice" value ="<?= $data['sellprice']?>" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Brand</label>
                                <input type="text" name="brand" value ="<?= $data['brand']?>" class="form-control">
                            </div>

                            <div class="form-select mb-3">
                                <label for="">Laboratory:</label>
                            <select  name="laboratory" class="form-control">
                                <?php $getLabs = "SELECT labid,fullname FROM laboratories";
                                $getLabsRun = mysqli_query($con, $getLabs);
                                if($getLabsRun->num_rows > 0){
                                 while($row = mysqli_fetch_assoc($getLabsRun)){ 
                                    echo "<option value=".$row['labid'].">".$row['fullname']."</option>";} }?>
                                </select> </div>

                            <div class="form-group mb-3">
                                <label for="">Quantity</label>
                                <input type="text" name="quantity" value ="<?= $data['quantity']?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="editItemButton" value="Confirm" class="btn btn-primary"> </input>
                                <a href="inventoryList.php" class="btn btn-secondary" role="button" aria-pressed="true">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<?php include('includes/footer.php');?>