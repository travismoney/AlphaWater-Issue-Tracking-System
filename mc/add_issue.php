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

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AlphaWater - Create Issue</title>
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
            <a class="navbar-brand" href="mc-dashboard">Welcome, <?php echo $user_first_name; ?></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
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
                            <a class="nav-link mt-3" href="mc-dashboard">
                                <div class="sb-nav-link-icon"><i class="fa fa-certificate mr-1"></i></div>
                                Dashboard
                            </a>
                            <!-- Projects -->
                            <a class="nav-link" href="projects">
                               <div class="sb-nav-link-icon"><i class="fa fa-road mr-1"></i></div>
                                Projects
                            </a>
                            <!-- Issues -->
                            <a class="nav-link" href="issues">
                                <div class="sb-nav-link-icon"><i class="fa fa-wrench mr-1"></i></div>
                                Issues
                            </a>
                            <!-- Users -->
                            <a class="nav-link" href="javascript:void(0)" onclick="location.href='users'" >
                                <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                                Users
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
                    <li class="breadcrumb-item active"><a href="issues">Issues </a>  <i class="fa fa-chevron-right" aria-hidden="true"></i> Add New Issue</li>
                        </ol>
                        <div class="card mb-4 shadow-lg">
                        <h2 class="mx-2 my-3 form-group col-md-6">Add New Issue</h2>
                        <div class="mx-2 panel-body"> 
                        <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">  
                        <!-- project_id -->
                        <div class="form-group">  
                                <label for="" class="control-label col-md-3">Project Name</label>
                                <div class="col-md-6">
                                    <select name="project_id" class="form-control" required>
                                        <option value="">Select Project Name</option>
                                        <?php
                                                       
                                            $get_project = "select * from projects";
                                                                                      
                                            $run_project = mysqli_query($con,$get_project);
                                                                                      
                                            while($row_project=mysqli_fetch_array($run_project)){
           
                                                $project_id = $row_project['project_id'];
                                                                                          
                                                $project_name = $row_project['project_name'];
                                                                                          
                                                echo "
                                                                                          
                                                <option value='$project_id' required> $project_name </option>
           
                                                ";
                                                
                                            }
                                                                                   
                                        ?>
                                    </select>
                                </div>
                           </div>
                            <!-- issue_title -->
                           <div class="form-group"> 
                               <label for="" class="control-label col-md-3">Issue Title</label>
                                <div class="col-md-6">
                                    <input style="border: 1px solid lightgrey !important;" name="issue_title" type="text" class="form-control" required>
                                </div>
                           </div>
                          <!-- issue_description -->
                           <div class="form-group">  
                                <label for="" class="control-label col-md-3">Issue Description</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="issue_description" id="" cols="30" rows="10" class="form-control" required></textarea>
                                </div>
                           </div> 
                          <!-- assignee -->
                           <div class="form-group">  
                                <label for="" class="control-label col-md-3">Assigned To</label>
                                <div class="col-md-6">
                                    <select name="assignee" class="form-control" required>
                                    <option value="">Select Assignee</option>
                                        <?php
                                                       
                                            $get_assignee= "select * from users where role ='Sub Contractor'";
                                                                           
                                            $run_assignee = mysqli_query($con,$get_assignee);
                                                                           
                                            while($row_assignee=mysqli_fetch_array($run_assignee)){

                                                $user_id = $row_assignee['user_id'];
                                                                               
                                                $first_name = $row_assignee['first_name'];

                                                $last_name = $row_assignee['last_name'];
                                                                               
                                                echo "
                                                                               
                                                <option value='$user_id'> $first_name $last_name </option>

                                                ";
                                            }
                                                                        
                                        ?>
                                    </select>
                                </div>
                           </div>
                            <!-- Form Group for Priority -->
                            <div class="form-group">  
                                <label for="" class="control-label col-md-3">Priority</label>
                                <div class="col-md-6">
                                <select name="priority" class="form-control" required>
                                    <option value="">Select Priority</option>
                                        <?php
                                                       
                                            $get_priority = "select * from priority";
                                                                           
                                            $run_priority = mysqli_query($con,$get_priority);
                                                                           
                                            while($row_priority=mysqli_fetch_array($run_priority)){

                                                $priority_id = $row_priority['priority_id'];
                                                                               
                                                $priority_name = $row_priority['priority_name'];
                                                                               
                                                echo "
                                                                               
                                                <option value='$priority_id' required> $priority_name </option>

                                                ";
                                            }
                                                                        
                                        ?>
                                    </select>
                                </div>
                           </div>
                            <!-- Attachment 1 -->
                            <div class="form-group">  
                                <label for="" class="control-label col-md-3">Picture Attachment (Required)</label>
                                <div class="col-md-6"> 
                                    <input name="attachment_1" style="border: 1px solid lightgrey !important;" type="file" class="form-control" required>
                                </div> 
                           </div> 

                           <!-- Button For Submit New Project -->
                           <div class="form-group"> 
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">  
                                    <input type="submit" value="Create Issue" name="submit" class="btn btn-primary form-control">
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

    if(isset($_POST['submit'])){
              
            $project_id = $_POST['project_id'];
              
            $issue_title = $_POST['issue_title'];

            $issue_description = $_POST['issue_description'];

            $assignee = $_POST['assignee'];
            
            $priority = $_POST['priority'];

            $issued_by = $_SESSION['user_id'];

            $current_progress = "1";

            $attachment_1 = $_FILES['attachment_1']['name'];
            
            $temp_name1 = $_FILES['attachment_1']['tmp_name'];
        
            move_uploaded_file($temp_name1,"../attachments/$attachment_1");

            $insert_new_issue= "insert into issues
            (project_id,
            issue_title,
            issue_description,
            issued_by,
            date_added,
            assignee,
            priority,
            current_progress,
            attachment_1)
            values
            ('$project_id',
            '$issue_title',
            '$issue_description',
            '$issued_by',
            NOW(),
            '$assignee',
            '$priority',
            '$current_progress',
            '$attachment_1')";
            
            $run_new_issue = mysqli_query($con,$insert_new_issue);

            if($run_new_issue){
                  
                echo "<script>alert('New Issue Added Succesfully!')</script>";
                  
                echo "<script>window.open('issues','_self')</script>";
                  
            }else{
                  
                echo "<script>alert('Error Try Again')</script>";

            }
              
          }
        }
        
?>
