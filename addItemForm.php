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
            ?>
                    <?php include('includes/roleNav.php'); ?>

                    <div class="card-shadow">
                    <div class="card-header">
                        <h5>Item Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="addItem.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Item Name</label>
                                <input type="text" name="itemname" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Quantity</label>
                                <input type="text" name="quantity" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Cost Price</label>
                                <input type="text" name="costprice" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Sell Price</label>
                                <input type="text" name="sellprice" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Brand</label>
                                <input type="text" name="brand" class="form-control">
                            </div>

                            <div class="form-select mb-3">
                                <label for="">Laboratory:</label>
                            <select  name="laboratory" class="form-control">
                                <?php $getLabs = "SELECT labid,fullname FROM laboratories";
                                $getLabsRun = mysqli_query($con, $getLabs);
                                if($getLabsRun->num_rows > 0){
                                 while($row = mysqli_fetch_assoc($getLabsRun)){ 
                                    echo "<option value=".$row['labid'].">".$row['fullname']."</option>";} }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="addItemButton" value="Confirm" class="btn btn-primary"> </input>
                                <a href="inventoryList.php" class="btn btn-secondary" role="button" aria-pressed="true">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>