<?php
session_start();
include("../include/db.php");

if(!isset($_SESSION['email_address'])){
    
    echo "<script>window.open('../index','_self')</script>";
    
}else{

    $user_session = $_SESSION['email_address']; 
    
    $get_user = "select * from users where email_address ='$user_session' ";
    
    $run_user = mysqli_query($con,$get_user);
    
    $row_user = mysqli_fetch_array($run_user);
    
    $_SESSION['user_id'] = $row_user['user_id'];

    $user_id = $_SESSION['user_id'];
        
    $user_first_name = $row_user['first_name'];

    $user_last_name = $row_user['last_name'];

    $user_email_address = $row_user['email_address'];

    $user_password = $row_user['password'];

    $user_confirm_password = $row_user['confirm_password'];

    $user_role = $row_user['role'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AlphaWater - Profile </title>
        <link rel="shortcut icon" type="image/jpg" href="../images/favicon-32x32.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <!--===============================================================================================-->	
	    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../css/util.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <!--===============================================================================================-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="sc-dashboard">Welcome, <?php echo $user_first_name; ?></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- Dashboard -->
                            <a class="nav-link mt-3" href="sc-dashboard">
                                <div class="sb-nav-link-icon"><i class="fa fa-certificate mr-1"></i></div>
                                Dashboard
                            </a>
                            <!-- Issues -->
                            <a class="nav-link" href="issues">
                                <div class="sb-nav-link-icon"><i class="fa fa-wrench mr-1"></i></div>
                                Issues
                            </a>
                            <!-- Profile -->
                            <a class="nav-link" href="profile">
                                <div class="sb-nav-link-icon"><i class="fa fa-user mr-1"></i></div>
                                Profile
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $user_first_name; ?> <?php echo $user_last_name; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <ol class="card mb-4 breadcrumb my-3 shadow-lg">
                    <li class="breadcrumb-item active"><a>Profile </a>
                        </ol>
                        <div class="card mb-4 shadow-lg">
                        <h4 class="mx-2 my-3 form-group col-md-6">Your Profile</h4>
                        <div class="mx-2 panel-body"> 
                        <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">  
                            <!-- Form Group for User First Name -->
                           <div class="form-group"> 
                               <label for="" class="control-label col-md-3">First Name</label>
                                <div class="col-md-6">
                                    <input style="border: 1px solid lightgrey !important;" name="first_name" type="text" class="form-control" required value="<?php echo $user_first_name; ?>">
                                </div>
                           </div>
                            <!-- Form Group for User Last Name -->
                            <div class="form-group"> 
                               <label for="" class="control-label col-md-3">Last Name</label>
                                <div class="col-md-6">
                                    <input style="border: 1px solid lightgrey !important;" name="last_name" type="text" class="form-control" required value="<?php echo $user_last_name; ?>">
                                </div>
                           </div>
                            <!-- Form Group for User Email Address -->
                            <div class="form-group"> 
                               <label for="" class="control-label col-md-3">Email</label>
                                <div class="col-md-6">
                                    <input style="border: 1px solid lightgrey !important;" name="email_address" type="text" class="form-control" required value="<?php echo $user_email_address; ?>">
                                </div>
                           </div>
                            <!-- Form Group for User Password -->
                            <div class="form-group"> 
                               <label for="" class="control-label col-md-3">Password</label>
                                <div class="col-md-6">
                                    <input style="border: 1px solid lightgrey !important;" name="password" type="password" class="form-control" required value="<?php echo $user_password; ?>">
                                </div>
                           </div>
                            <!-- Form Group for User Confirm Password -->
                            <div class="form-group"> 
                               <label for="" class="control-label col-md-3">Confirm Password</label>
                                <div class="col-md-6">
                                    <input style="border: 1px solid lightgrey !important;" name="confirm_password" type="password" class="form-control" required value="<?php echo $user_confirm_password; ?>">
                                </div>
                           </div>
                            <!-- Form Group for User First Name -->
                            <div class="form-group"> 
                               <label for="" class="control-label col-md-3">User Type</label>
                                <div class="col-md-6">
                                    <input style="border: 1px solid lightgrey !important;" name="role" type="text" class="form-control" required value="<?php echo $user_role; ?>" readonly>
                                </div>
                           </div>
                           <!-- button for save and delete project changes -->
                           <div class="form-group"> 
                                <div class="col-md-6">  
                                    <input type="submit" value="Save Changes" name="save_profile" class="btn btn-success form-control mt-3">
                                    <input type="submit" value="Delete Account" name="delete_profile" class="btn btn-danger form-control my-3">
                               </div>  
                          </div> 
                       </form>  
                    </div>  
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted text-center" style="margin: 0px auto;">AlphaWater - UNIMAS SUSTAINABLE WATER TREATMENT SYSTEM</div>
                </div>
            </div>
        </footer>
        </div>
        </div>
        <script>

            // New Notification

            function NewNotification(firstName,lastName,issue,information){

                var first_name = firstName;
                var last_name = lastName;
                var issue_id = issue;
                var information_details = information;
                var fullName = first_name + ' ' + last_name;
                var completeSentence = information_details + issue_id;
                var addressLink = "issues-detailed?issue_detailed=" + issue_id;

                const PushNotification = new Notification("AlphaWater: Notification", {

                body: fullName + ' ' + completeSentence

                });

                PushNotification.onclick = function(event) {
                event.preventDefault(); // prevent the browser from focusing the Notification's tab
                window.open(addressLink, '_blank');
                }

            }

            // Sending A New Noticiation If There Is A New Issue

            var count_notifications = -1;

            setInterval(function(){    

            // Notifying New Comments

            $.ajax({
            type : "POST",
            url : "notification_alerts",
            success : function(response){

                if (count_notifications != -1 && count_notifications != response){

                    $.ajax({
                    type : "POST",
                    url : "latest_notification",
                    dataType: "json",
                    success : function(response){

                            response1 = response[0]; // first name
                            response2 = response[1]; // last name
                            response3 = response[2]; // issue id
                            response4 = response[3]; // update information

                            console.log(response1);
                            console.log(response2);
                            console.log(response3);
                            console.log(response4);

                            NewNotification(response1,response2,response3,response4);

                        } 

                });

                } 

                count_notifications = response;
            }

            });

            },1000);

        </script>
        <script src="../js/canvasjs.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js" integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>

<?php  

    // save profile

    if(isset($_POST['save_profile'])){
              
        $first_name = $_POST['first_name'];
              
        $last_name = $_POST['last_name'];

        $email_address = $_POST['email_address'];

        $password = $_POST['password'];

        $confirm_password = $_POST['confirm_password'];

        $role = $_POST['role'];

        $user_id = $_SESSION['user_id'];
              
        $update_profile = "update users set 
        first_name = '$first_name', 
        last_name = '$last_name', 
        email_address = '$email_address',
        password = '$password',
        confirm_password = '$confirm_password',
        role = '$role' 
        where user_id = '$user_id'
        ";
              
        $run_profile_update = mysqli_query($con,$update_profile);
              
        if($run_profile_update){
                  
            echo "<script>alert('Your profile has been updated!')</script>";
                  
            echo "<script>window.open('profile','_self')</script>";
                     
        }else{

            echo "<script>alert('Profile Update Failed, Try Again!')</script>";
                  
            echo "<script>window.open('profile','_self')</script>";
        }
              
    }

    // delete profile

    if(isset($_POST['delete_profile'])){

        $delete_profile_id = $_SESSION['user_id'];
                
        $delete_profile_query = "delete from users where user_id = '$delete_profile_id' ";
                
        $run_delete_profile = mysqli_query($con,$delete_profile_query);
                
            if($run_delete_profile){
    
                    echo "<script>alert('Your Account Has Been Deleted!')</script>";
                    
                    echo "<script>window.open('../logout','_self')</script>";
                    
                    
            }
             
                
    }
           
}

?>