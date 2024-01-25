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
            ?><?php include('includes/roleNav.php'); ?>
                <div class="col-md-12 text-center">
                        <form action="searchSale.php" method="post" class="form-inline justify-content-center">
                        <li><strong>From Date</strong></li>
                        <input type="text" class="form-control" id="dateFrom" /> &nbsp;
                        <li><strong>To Date</strong></li>
                        <input type="text" class="form-control" id="dateTo" />&nbsp;
                        <button type="searchSale" class="btn btn-dark">Search</button>
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
                            <th scope="col">Date</th>
                            </thead>
                        </nav>
                        <tr>

                        
                        <?php 
                         $getPurch = "SELECT * FROM orders WHERE orderStatus = 1";
                         $getPurchRun = mysqli_query($con, $getPurch);
                        if($getPurchRun->num_rows > 0){
                            while($row = mysqli_fetch_assoc($getPurchRun)){   
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
                                echo "<td>". $row['date'] ."</td>";
                                    
                        
                        
                        } }
                        ?></div>      


            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>