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
                }?>
            <?php include('includes/roleNav.php'); ?>

                        <div class="col-md-12 text-center">
                            <form action="searchOrd.php" method="post" class="form-inline justify-content-center">
                            <select  name="searchOrder" class="form-control">
                                    <option value="1">Approved</option>
                                    <option value="2">Denied</option>
                                    <option value="0">Pending</option>
                                </select>
                            <button type="searchOrd" class="btn btn-dark">Search</button>
                            </form>
                        </div>

                        

                        <table class="table table-hover">
                        <thead class="thead-dark">
                            <th scope="col">#</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Laboratory Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Cost</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                            </thead>
                        <?php 
                         $getRequests = "SELECT * FROM orders";
                         $getRequestsRun = mysqli_query($con, $getRequests);
                        if($getRequestsRun->num_rows > 0){
                            while($row = mysqli_fetch_assoc($getRequestsRun)){
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
                            
                            $userid = $row['userid'];
                            $getUser = "SELECT firstName,lastName FROM users WHERE id='$userid'";
                            $row4 = mysqli_fetch_assoc(mysqli_query($con, $getUser));
                            echo "<td>". $row4['firstName'].(" ").$row4['lastName']."</td>";
                            
                            echo "<td>". $row['quantity'] ."</td>";
                            echo "<td>". $row['cost'] ."</td>";
                            echo "<td>". $row['descr'] ."</td>";

                            if($row['orderStatus'] =='0'){
                            echo "<td> <span class='badge bg-warning'>Pending</span></td>";
                            echo "<td>". $row['date'] ."</td>";
                            echo "<td>";

                            echo "<div class='btn-group'>";
                            echo "<a class='btn btn-success' href='../order_func/yesOrder.php?orderid=" .$row['orderid'] ."'>Confirm</a>";
                            echo " <a class='btn btn-danger' href='../order_func/denyOrder.php?orderid=" .$row['orderid'] ."'>Deny</a>";
                            echo "</div>";
                            echo "</td>";}
                            else if($row['orderStatus'] =='1'){
                            echo "<td> <span class='badge bg-success'>Approved</span></td>";
                            echo "<td>". $row['date'] ."</td>";
                            } else {
                            echo "<td> <span class='badge bg-danger'>Denied</span></td>";
                            echo "<td>". $row['date'] ."</td>";   
                            }
                            
                            echo "</tr>";
                        
                        } }
                        ?>
                </div>     
            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>