<?php 

session_start();
include("include/db.php");

// email and password for login 
$email_address= $_POST['email_address'];
$password = $_POST['password'];
 
// login database
$login = mysqli_query($con,"select * from users where email_address='$email_address' and password='$password'");
$check = mysqli_num_rows($login);
 
// check password and email address from database
if($check > 0){
 
	$data = mysqli_fetch_assoc($login);
  
  // Main Contractor section
	if($data['role']=="Main Contractor"){
 
		$_SESSION['email_address'] = $email_address;
		$_SESSION['user_id'] = $user_id;

        header("location:mc/mc-dashboard");
 
	// sub-contractor section
	}else if($data['role']=="Sub Contractor"){
		
		$_SESSION['email_address'] = $email_address;
		$_SESSION['user_id'] = $user_id;

		//Logged in As
		header("location:sc/sc-dashboard");
 
	// representative-of-community
	}else if($data['role']=="Representative Of Community"){
		
		$_SESSION['email_address'] = $email_address;
		$_SESSION['user_id'] = $user_id;

		//Logged in As
		header("location:roc/roc-dashboard"); 
 
	}else{

		echo "<script>alert('Wrong Email or Password Entered! Please Try Again!')</script>";
		echo "<script>window.open('index','_self')</script>";
	}	
}else{

	echo "<script>alert('Invalid Email or Password Entered! Please Try Again!')</script>";
	echo "<script>window.open('index','_self')</script>";
}
 
?>