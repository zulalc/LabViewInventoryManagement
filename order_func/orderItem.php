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
                    unset($_SESSION['status']);

                    
                }
                
                if(!isset($_GET['itid'])){
                    //redirect to dashboard
                    $_SESSION['status']= "ID is not provided.";
                    header("Location: ../inventoryList.php");
                }

                $itid = $_GET['itid'];

                $selectItem = "SELECT * FROM  `items` WHERE itid = $itid";
                $selectItemRun = mysqli_query($con, $selectItem);

                $data = mysqli_fetch_array($selectItemRun); 

                if($data['quantity']>0){
                    ?>
                    <?php include('../includes/roleNav.php'); ?>
                    <div class="form-group">
                    <div class="card-body">
                        <form action="orderConfirm.php?itid=<?= $itid?>" method="POST">


                            <div class="card w-90">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data['itemname']?></h5>
                                <p class="card-text">Price: <?= $data['sellprice']?></p>
                                <p class="card-text">Quantity: <?= $data['quantity']?></p>
                                <div class="form-group mb-3">
                                <label for="">Order</label>

                                <select name="quantity" class="form-control">
                                    <?php
                                    for($i=1;$i<=$data['quantity'];$i++){
                                        echo "<option>$i</option>";
                                    }?>
                                </select>

                                <div class="form-group mb-3">
                                <label for="">Description: (Write Your Reason)</label>
                                <input type="text" name="descr" class="form-control">
                                </div>

                                <input type="submit" name="orderButton" value="Confirm" class="btn btn-success"> </input>
                                <a href="../inventoryList.php" class="btn btn-secondary" role="button" aria-pressed="true">Cancel</a>
                                </div>
                            
                            </div>
                            


                            

            </div>
            <?php
                }else{
                    header("Location: ../inventoryList.php");
                }
            ?>
        </div>
    </div>

</div>