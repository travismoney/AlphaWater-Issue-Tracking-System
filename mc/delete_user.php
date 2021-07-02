<?php

if(!isset($_SESSION['email_address'])){
    
    echo "<script>window.open('../index','_self')</script>";
    
}else{

    if(isset($_GET['delete_user'])){
        
        $delete_id = $_GET['delete_user'];
        
        $delete_user = "delete from users where user_id='$delete_id'";
        
        $run_delete_user = mysqli_query($con,$delete_user);
        
        if($run_delete_user){
            
            echo "<script>alert('User has been removed!')</script>";
            
            echo "<script>window.open('users','_self')</script>";
            
            
        }
     
        
    }
    
}
      
?>
