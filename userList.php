<?php
include('includes/authentication.php');
$page_title = "Admin Dashboard Page";
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
            ?><?php include('includes/adminNavbar.php'); ?>
                        
                        
                        <table class="table table-hover">
                        <thead class="thead-dark">
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                            </thead>
                        </nav>
                        <tr>

                        
                        <?php 
                         $getUsers = "SELECT * FROM Users";
                         $getUsersRun = mysqli_query($con, $getUsers);
                         $totaluser = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(id) FROM Users"));
                        if($getUsersRun->num_rows > 0){
                            while($row = mysqli_fetch_assoc($getUsersRun)){
                            echo "<tr>";
                            echo "<td>". $row['id'] ."</td>";
                            echo "<td>". $row['firstName'] ."</td>";
                            echo "<td>". $row['lastName'] ."</td>";
                            echo "<td>". $row['phone'] ."</td>";
                            echo "<td>". $row['email'] ."</td>";
                            echo "<td>". $row['role'] ."</td>";
                            echo "<td>";

                            
                            if($_SESSION["role"] == "admin") {
                            echo "<div class='btn-group'>";
                            echo "<a class='btn btn-secondary' href='../admin_func/editUserForm.php?id=" .$row['id'] ."'> Edit</a>";
                            echo " <a class='btn btn-danger' href='../admin_func/deleteUser.php?id=" .$row['id'] ."'> Delete</a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                                } } }
                        ?>
                        
                </div>
                <div class="card-body">
                <?php echo "<button type='button' class='btn btn-secondary pull-left'>Total Users: $totaluser[0]</button>" ?>
                <a href="../admin_func/addUserForm.php" class="btn btn-primary pull-right">Add User</a>
                    </div>         


            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>