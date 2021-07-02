<?php

session_start();

include("../include/db.php");

if(!isset($_SESSION['email_address'])){
    
    echo "<script>window.open('../index','_self')</script>";
    
}else{

    $user_session = $_SESSION['email_address']; 

    $sql = "select * from recent_updates"; 

    $qry = mysqli_query($con,$sql);

    $res = mysqli_num_rows($qry);  

    echo $res;

}