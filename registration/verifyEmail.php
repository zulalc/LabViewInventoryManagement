<?php
session_start();
include('../database/dbCon.php');
    if(isset($_GET['token'])){
    $token = $_GET['token'];
    $verifTok = "SELECT verifyToken,verifyStatus FROM users WHERE verifyToken = '$token' LIMIT 1";
    $verifyTokRun = mysqli_query($con , $verifTok);

    if(mysqli_num_rows($verifyTokRun) > 0){

        $row = mysqli_fetch_array($verifyTokRun);
            if($row['verifyStatus'] == "0"){ //its not verified
                $clickedToken = $row['verifyToken'];
                $updateTokStat = "UPDATE users SET verifyStatus='1' WHERE verifyToken ='$clickedToken' LIMIT 1";
                $updateTokStatRun = mysqli_query($con,$updateTokStat);

                if($updateTokStat){
                    $_SESSION['status'] = "Verification Succesfull.";
                    header("Location: login.php");
                    exit(0);
                }else{
                    $_SESSION['status'] = "Verification Failed.";
                    header("Location: login.php");
                    exit(0);
                }


            }else {
            $_SESSION['status'] = "Email Already Verified. Please Login.";
            header("Location: login.php");
            exit(0); //directly exit
        }


        } else {
        $_SESSION['status'] = "Something Went Wrong";
        header("Location: login.php");
}

}else {
    $_SESSION['status'] = "Please Login to See This Page";
    header("Location: login.php");
}

?>