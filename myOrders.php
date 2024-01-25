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
                        
                        <table class="table table-hover">
                        <thead class="thead-dark">
                            <th scope="col">#</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Laboratory</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            
                            </thead>
                        </nav>
                        <tr>
                        <?php 
                         $userid= implode($_SESSION['userID']);
                         $getO = "SELECT * FROM orders WHERE userid= $userid";
                         $getORun = mysqli_query($con, $getO);

                        if($getORun->num_rows > 0){
                            while($row = mysqli_fetch_assoc($getORun)){
                        
                            echo "<tr>";
                            echo "<td>". $row['orderid'] ."</td>";
                            $itid = $row['itid'];
                            $getitid = "SELECT items.itemname, items.brand FROM items WHERE items.itid= $itid";
                            $row2 = mysqli_fetch_assoc(mysqli_query($con, $getitid));
                            echo "<td>". $row2['itemname'] ."</td>";

                            $labid = $row['labid'];
                            $getLab = "SELECT fullname FROM laboratories WHERE labid='$labid'";
                            $row3 = mysqli_fetch_assoc(mysqli_query($con, $getLab));
                            echo "<td>". $row3['fullname'] ."</td>";
                            
                            echo "<td>". $row['quantity'] ."</td>";
                            echo "<td>". $row['cost'] ."</td>";
                            
                            echo "<td>". $row2['brand'] ."</td>";

                            if($row['orderStatus'] =='0'){
                                echo "<td> <span class='badge bg-warning'>Pending</span></td>";
                            }
                            else if($row['orderStatus'] =='1'){
                            echo "<td> <span class='badge bg-success'>Approved</span></td>";
                            }else {
                            echo "<td> <span class='badge bg-danger'>Denied</span></td>";
                              
                                } 
                            echo "<td>". $row['date'] ."</td>";
                            echo "<td>";
                            echo "<div class='btn-group'>";
                             } }
                             
                        ?>
                        
                </div>      
            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php');?>