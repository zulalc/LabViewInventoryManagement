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
                                                ?>     
                        <div class="col-md-12 text-center">
                        <form action="searchItem.php" method="post" class="form-inline justify-content-center">
                        <input type="text" placeholder="Search" name="search" class="form-control"> &nbsp;
                        <button type="search" class="btn btn-dark">Search</button>
                        </form>
                    </div>
                            
                        <table class="table table-hover">
                        <thead class="thead-dark">
                            <th scope="col">#</th>
                            <th scope="col">QR</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Cost Price</th>
                            <th scope="col">Sell Price</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Laboratory</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Actions</th>
                            </thead>
                        </nav>
                        <tr>
                        
                        <?php
                         
                         $getItems = "SELECT * FROM items";
                         $getItemsRun = mysqli_query($con, $getItems);
                         $totalitems = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(itid) FROM items"));
                         echo "<button type='button' class='btn btn-secondary pull-left'>Total Items: $totalitems[0]</button>";
                        if($getItemsRun->num_rows > 0){
                            while($row = mysqli_fetch_assoc($getItemsRun)){
                            $labid = $row['labid'];
                            $getLab = "SELECT fullname FROM laboratories WHERE labid='$labid'";
                            $getLabRun = mysqli_query($con, $getLab);

                            echo "<tr>";
                            echo "<td>". $row['itid'] ."</td>";
                            echo "<td> <img src='/qr_images/{$row['iQR']}'</td>";
                            echo "<td>". $row['itemname'] ."</td>";
                            echo "<td>". $row['costprice'] ."</td>";
                            echo "<td>". $row['sellprice'] ."</td>";
                            echo "<td>". $row['brand'] ."</td>";
                            while($row2 = mysqli_fetch_assoc($getLabRun)){ 
                            echo "<td>". $row2['fullname'] ."</td>";   
                            }
                            echo "<td>". $row['quantity'] ."</td>";
                            echo "<td>";
                            echo "<div class='btn-group'>";
                            echo "<a class='btn btn-success' href='../order_func/orderItem.php?itid=" .$row['itid'] ."'>Order</a>";
                            
                            
                            if($_SESSION["role"] == "admin") {
                            echo "<div class='btn-group'>";
                            echo "<a class='btn btn-secondary' href='editItemForm.php?itid=" .$row['itid'] ."'>Edit</a>";
                            echo "<a class='btn btn-danger' href='deleteItem.php?itid=" .$row['itid'] ."'> Delete</a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                                } } }

                            if($_SESSION["role"] == "admin" || $_SESSION["role"] == "staff" ) {
                            echo "<div class='card-body'>";
                            echo "<a href='addItemForm.php' class='btn btn-primary pull-right'>Add Item</a>";
                            echo "</div>";
                            }
                ?> 
                
                </div>      
            </div>
        </div>
    </div>

</div>
<?php include('includes/footer.php');?>