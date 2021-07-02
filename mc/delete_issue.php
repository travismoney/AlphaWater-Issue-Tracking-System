<?php

session_start();
include("../include/db.php");

if(!isset($_SESSION['email_address'])){
    
    echo "<script>window.open('../index','_self')</script>";
    
}else{
      
    if(isset($_GET['delete_issue'])){
        
        $delete_issue_id = $_GET['delete_issue'];
        
        $delete_issue = "delete from issues where issue_id='$delete_issue_id'";
        
        $run_delete = mysqli_query($con,$delete_issue);
        
        if($run_delete){
            
            echo "<script>alert('Issue has been removed!')</script>";
            
            echo "<script>window.open('issues','_self')</script>";
            
            
        }
     
        
    }

}
     
      
?>
