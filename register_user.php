<?php  


include("include/db.php");

if(isset($_POST['submit'])){
              
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
                    
    $insert_new_user = 
    "insert into users 
    (first_name,
    last_name,
    email_address,
    password,
    confirm_password,
    role,
    date_registered) 
    values 
    ('$first_name',
    '$last_name',
    '$email_address',
    '$password',
    '$confirm_password',
    '$role',
    NOW())";
    
    $run_new_user = mysqli_query($con,$insert_new_user);
              
    if($run_new_user){
                  
        echo "<script>alert('Registration Success!')</script>";
                  
        echo "<script>window.open('index','_self')</script>";
                  
    }else{
                  
        echo "<script>alert('Registration Not Success! Try Again')</script>";

        echo "<script>window.open('register','_self')</script>";
              
    }
              
}

?>