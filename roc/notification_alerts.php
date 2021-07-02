<?php

session_start();

include("../include/db.php");

if(!isset($_SESSION['email_address'])){
    
    echo "<script>window.open('../index','_self')</script>";
    
}else{

    $user_session = $_SESSION['email_address']; 

    $get_current_user = "select * from users where email_address = '$user_session' ";
    
    $run_current_user = mysqli_query($con,$get_current_user);
    
    $row_current_user = mysqli_fetch_array($run_current_user);
    
    $_SESSION['user_id'] = $row_current_user['user_id'];

    $current_user_id = $_SESSION['user_id'];

    $sql = "select * from recent_updates where issuer_id = '$current_user_id' and user_id != '$current_user_id'"; 

    $qry = mysqli_query($con,$sql);

    $res = mysqli_num_rows($qry);  

    echo $res;

}