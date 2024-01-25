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
                        
                        
                        <table class="table table-hover">
                        <thead class="thead-dark">
                            <th scope="col">#</th>
                            <th scope="col">Laboratory Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Phone#</th>
                            </thead>
                        </nav>
                        <tr>

                        
                        <?php 

                         $getlabs = "SELECT * FROM laboratories";
                         $totallab = "SELECT COUNT(labid) FROM laboratories";
                         $total= mysqli_fetch_row(mysqli_query($con,$totallab));
                         echo $total[0];
                         $getLabsRun = mysqli_query($con, $getlabs);
                        if($getLabsRun->num_rows > 0){
                            while($row = mysqli_fetch_assoc($getLabsRun)){
                            echo "<tr>";
                            echo "<td>". $row['labid'] ."</td>";
                            echo "<td>". $row['fullname'] ."</td>";   
                            echo "<td>". $row['location'] ."</td>";
                            echo "<td>". $row['phone'] ."</td>";
                            echo "<td>";
                            echo "<div class='btn-group'>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                            
                            
                            echo "<div class='btn-group'>";
                        } }
                        ?>
                        
                </div>     
            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>