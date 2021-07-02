<?php
session_start();
include("../include/db.php");

if(!isset($_SESSION['email_address'])){
    
    echo "<script>window.open('../index','_self')</script>";
    
}else{

    $user_session = $_SESSION['email_address']; 
    
    $get_current_user = "select * from users where email_address ='$user_session' ";
    
    $run_current_user = mysqli_query($con,$get_current_user);
    
    $row_current_user = mysqli_fetch_array($run_current_user);
    
    $_SESSION['user_id'] = $row_current_user['user_id'];

    $current_user_id = $_SESSION['user_id'];

    $sql = "select * from recent_updates where assignee_id = '$current_user_id' and user_id != '$current_user_id' and update_information != 'added a new Issue #' order by recent_update_id desc limit 1";

    $qry = mysqli_query($con,$sql);

    $row_query = mysqli_fetch_array($qry);
        
    $user = $row_query['user_id'];

    // getting user name

    $get_user = "select * from users where user_id = '$user'";

    $get_user_query = mysqli_query($con,$get_user);

    $run_user_query = mysqli_fetch_array($get_user_query);

    $user_first_name = $run_user_query['first_name'];

    $user_last_name = $run_user_query['last_name'];

    $issue = $row_query['issue_id'];

    $information = $row_query['update_information'];

    $returnArr = [$user_first_name,$user_last_name,$issue,$information]; 

    echo json_encode($returnArr);


}