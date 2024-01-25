<div class="bg-light">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"> <img src="../logo.png" width="140" height="46"</img></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <?php if(!isset($_SESSION['authenticated'])):?>
                                <li class="nav-item">
                                <a class="nav-link active" href="../index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../registration/register.php">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../registration/login.php">Login</a>
                                </li>
                                <?php endif ?>

                                <?php if(isset($_SESSION['authenticated']) && isset($_SESSION['authUser'])) :?>
                                 <p><mark><?php echo 'Welcome '.implode(" ", $_SESSION['authUser']);?>!</mark></p>
                                
                                    
                                <?php if($_SESSION["role"] == "admin") { ?> 

                                 <li class="nav-item">
                                    <a class="nav-link" href="../dashboard/adminDash.php">Admin Dashboard</a>
                                </li>    
                                
                                 <?php } else if ($_SESSION["role"] == "staff") { ?> 
                                 <li class="nav-item">
                                    <a class="nav-link" href="../dashboard/staffDash.php">Staff Dashboard</a>
                                </li> 
                                
                                
                                 <?php } else {?> 
                                 <li class="nav-item">
                                    <a class="nav-link" href="../dashboard/userDash.php">User Dashboard</a>
                                </li>    
                                 <?php } ?>
                                        
                                <li class="nav-item">
                                    <a class="nav-link" href="../registration/logout.php">Logout</a>
                                </li>
                                
                                <?php endif ?>
                            </ul>


                        </div>
                    </div>
                    </nav>
                </div>
            </div>
        </div>
    </div> 
</div>
