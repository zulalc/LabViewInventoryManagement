<?php
session_start();
include('../database/dbCon.php');

if(isset($_POST['loginButton'])) {

    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))){ //

           $email = mysqli_real_escape_string($con,$_POST['email']);
           $password = mysqli_real_escape_string($con,$_POST['password']);
            $loginCheck = "SELECT * FROM users WHERE email='$email'";
            $loginCheckRun = mysqli_query($con,$loginCheck);

            if(mysqli_num_rows($loginCheckRun) > 0){

                $row = mysqli_fetch_array($loginCheckRun);

             
            if(password_verify($password, $row['password'])){

                if($row['verifyStatus'] == "1"){

                    $_SESSION['authenticated'] = TRUE;
                    $_SESSION['authUser'] = [
                        'firstName' => $row['firstName'],
                        'lastName' => $row['lastName'],
                    ];
                    
                    $_SESSION['userID'] = [strval($row['id']),];

                    //GO TO DASHBOARD BASED ON THE ROLE
                    $getRole = "SELECT role FROM users WHERE email='$email'";
                    $getRoleRun = mysqli_query($con,$getRole);
                    $rowRole = mysqli_fetch_array($getRoleRun);
                    echo $rowRole;

                        if($rowRole ['role']== "Administrator"){
                            $_SESSION["role"] = "admin";
                            $_SESSION['status'] = "You are Logged In.";
                            header('Location: ../dashboard/adminDash.php');
                            exit(0);
                        }
                        else if($rowRole ['role'] == "Staff"){  
                            $_SESSION["role"] = "staff";  
                            $_SESSION['status'] = "You are Logged In.";                       
                            header('Location: ../dashboard/staffDash.php');
                            exit(0);
                        } else if($rowRole ['role'] == "User"){    
                            $_SESSION["role"] =  "user"; 
                            $_SESSION['status'] = "You are Logged In.";                       
                            header('Location: ../dashboard/userDash.php');
                            exit(0);
                       }
                    

                }else{
                    $_SESSION['status'] = "Please Verify your Email Address.";
                    header("Location: login.php");
                    exit(0);
                }

            }else {
                $_SESSION['status'] = "Invalid Email or Password";
                header("Location: login.php");
                exit(0);
            }


    }else{
        $_SESSION['status'] = "All fields are mandatory.";
        header("Location: login.php");
    } 
}


}



?>