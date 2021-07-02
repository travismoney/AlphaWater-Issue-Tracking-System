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

if(isset($_GET['issue_detailed'])){
        
    $view_issue_id = $_GET['issue_detailed'];

    $view_issue_query = "select * from issues where issue_id = '$view_issue_id'";

    $run_view_issue = mysqli_query($con,$view_issue_query);
    
    $run_issue = mysqli_query($con,$view_issue_query);
    
    $row_issue = mysqli_fetch_array($run_issue);
    
    $issue_id = $row_issue['issue_id'];

    $_SESSION['issue_id'] = $row_issue['issue_id'];

    $project_id = $row_issue['project_id'];

    $issue_title = $row_issue['issue_title'];

    $issue_description = $row_issue['issue_description'];

    $date_added = new DateTime($row_issue['date_added']);

    $date_added_formatted = date_format($date_added, "d F Y - h:i A");

    $issued_by = $row_issue['issued_by'];

    $assignee = $row_issue['assignee'];

    $priority = $row_issue['priority'];

    $current_progress = $row_issue['current_progress'];

    $attachment_1 = $row_issue['attachment_1'];

    $get_project = "select * from projects where project_id = '$project_id'";

    $run_project = mysqli_query($con,$get_project);

    while($row_project=mysqli_fetch_array($run_project)){
        
        $project_name = $row_project['project_name'];

        $get_assignee = "select * from users where user_id = '$assignee'";

        $run_assignee = mysqli_query($con,$get_assignee);

        while($row_assignee=mysqli_fetch_array($run_assignee)){

            $assignee_first_name = $row_assignee['first_name'];

            $assignee_last_name = $row_assignee['last_name'];

            $get_issuer = "select * from users where user_id = '$issued_by'";
    
            $run_issuer = mysqli_query($con,$get_issuer);

            while($row_issuer=mysqli_fetch_array($run_issuer)){

                $issuer_first_name = $row_issuer['first_name'];
    
                $issuer_last_name = $row_issuer['last_name'];

                $get_priority = "select * from priority where priority_id ='$priority'";

                $run_priority = mysqli_query($con,$get_priority);

                while($row_priority = mysqli_fetch_array($run_priority)){

                    $priority_id = $row_priority['priority_id'];

                    $priority_name = $row_priority['priority_name'];

                    $get_status = "select * from status where status_id ='$current_progress'";
                                            
                    $run_status = mysqli_query($con,$get_status);
        
                    while($row_status = mysqli_fetch_array($run_status)){
        
                        $status_id = $row_status['status_id'];
        
                        $current_progress_name = $row_status['status_name'];
                    }
                }
            }
    
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AlphaWater - Issue #<?php echo $issue_id; ?> </title>
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

        <link rel="stylesheet" href="../dist/css/lightbox.min.css">

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
                        <li class="breadcrumb-item active"><a href="issues">Issues </a>  <i class="fa fa-chevron-right" aria-hidden="true"></i> #<?php echo $issue_id; ?> (<?php echo $issue_title; ?>) </li>
                        </ol>
                        <!-- Issue Detailed Starts! -->
                        <div class="card mb-4 shadow-lg">
                        <div class="card-header">
                            <div class="row ml-0 pt-3" style="display: flex !important; background-color: rgba(0, 0, 0, 0.001);">
                                <div class="col-sm-8">
                                    <h5>Issue <?php echo $issue_id; ?></h5>
                                </div>
                                <div class="col-sm-4">
                                    <button onclick="location.href='update_progress?update_progress=<?php echo $issue_id; ?>'" type="button" class="btn btn-success float-right">Update Progress</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body col-md-12 bg-white">
                            <div class="limiter">
                            <div class="form-group row" style="display: flex !important; background-color: transparent; padding-right: 0px !important; padding-top: 0px !important;">
                                    <!-- Issue Title -->
                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Issue Title</label>
                                    <div class="col-sm-4 my-2">
                                        <input type="email" class="form-control" id="colFormLabel" placeholder="<?php echo $issue_title; ?>" readonly>
                                    </div>
                                        
                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Date/Time Issued</label>
                                    <div class="col-sm-4 my-2">
                                        <input type="email" class="form-control" id="colFormLabel" placeholder="<?php echo $date_added_formatted; ?>" readonly>
                                    </div>

                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Description</label>
                                    <div class="col-sm-4 my-2">
                                        <textarea name="product_weight" cols="19" rows="5" class="form-control" style="border: none" placeholder="<?php echo $issue_description; ?>" readonly></textarea>
                                    </div>

                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Issued By</label>
                                    <div class="col-sm-4 my-2">
                                        <input type="email" class="form-control" id="colFormLabel" placeholder="<?php echo $issuer_first_name; ?> <?php echo $issuer_last_name; ?>" readonly>
                                    </div>

                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Assigned To</label>
                                    <div class="col-sm-4 my-2">
                                        <input type="email" class="form-control" id="colFormLabel" placeholder="<?php echo $assignee_first_name  ?> <?php echo $assignee_last_name  ?>" readonly>
                                    </div>

                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Project Name</label>
                                    <div class="col-sm-4 my-2">
                                        <input type="email" class="form-control" id="colFormLabel" placeholder="<?php echo $project_name; ?>" readonly>
                                    </div>

                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Priority</label>
                                    <div class="col-sm-4 my-2">
                                        <input type="email" class="form-control" id="colFormLabel" placeholder="<?php echo $priority_name; ?>" readonly>
                                    </div>

                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Status</label>
                                    <div class="col-sm-4 my-2">
                                        <input type="email" class="form-control" id="colFormLabel" placeholder="<?php echo $current_progress_name; ?>" readonly>
                                    </div>

                                    <label for="colFormLabel" class="col-sm-2 col-form-label my-2">Attachments</label>
                                    <div class="col-sm-10 my-2">
                                        <a class="example-image-link" href="../attachments/<?php echo $attachment_1; ?>" data-lightbox="example-set">
                                            <img src="../attachments/<?php echo $attachment_1; ?>" width="200" height="200">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        </div>
                        <!-- Issue Details Ends! -->

                        <!-- Comments Section Starts! -->
                        <div id="chat-section" class="card mb-4 shadow-lg" style="margin-bottom: 80px !important;">
                            <div class="card-header"><h5 class="ml-2">Comments</h5></div>
    	                        <div class="card-body col-md-12 bg-white" >
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="chat-message section-message-scroll">
                                            <ul class="chat">
                                            <?php
                                                
                                                $get_comments = "select * from comments where issue_id = '$issue_id'";

                                                $run_comments = mysqli_query($con,$get_comments);
                                            
                                                while($row_comments=mysqli_fetch_array($run_comments)){

                                                    $user_comment_id = $row_comments['user_id'];
                                            
                                                    $comments = $row_comments['comments'];
                                            
                                                    $comment_time = $row_comments['comment_time'];

                                                    $get_username = "select * from users where user_id = '$user_comment_id'";

                                                    $run_username = mysqli_query($con,$get_username);

                                                    while($row_username=mysqli_fetch_array($run_username)){

                                                        $user_first_name = $row_username['first_name'];
                                            
                                                        $user_last_name = $row_username['last_name'];
                                            

                                            ?>

                                                <!-- Other People Message -->
                                                <li class="left clearfix">
                    	                            <div class="chat-body clearfix">
                    		                            <div class="header">
                    			                            <strong class="primary-font"><?php echo $user_first_name; ?> <?php echo $user_last_name; ?></strong>
                    			                            <small class="pull-right text-muted">(<?php echo $comment_time; ?>)</small>
                    		                            </div>
                    		                            <p>
                    			                        <?php echo $comments; ?>
                    		                             </p>
                    	                            </div>
                                                </li> 
                                                <?php } } ?>                                  
                                            </ul>
                                        </div>
                                        <div class="chat-box bg-white">
            	                            <div class="input-group">
            		                            <input name="comments" class="form-control border no-shadow no-rounded" placeholder="Type your message here">
            		                            <span class="input-group-btn">
            			                            <button name="send_message" class="btn btn-success no-rounded" type="submit">Send</button>
            		                            </span>
            	                            </div><!-- /input-group -->	
                                        </div>  
                                    </form>
		                        </div>        
	                        </div>
                        </div>
                    </div> 
                    <!-- Comments Section Ends! -->
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

                        <!-- Lightbox JS -->
                        <script src="../dist/js/lightbox-plus-jquery.min.js"></script>
    </body>
</html>

<?php
                               
if(isset($_GET['update_progress'])){
                    
    include("update_progress");
                    
}


if(isset($_POST['send_message'])){
              
    $issue_id = $_SESSION['issue_id'];
      
    $user_id = $_SESSION['user_id'];

    $comments = $_POST['comments'];

    $insert_new_comment = "insert into comments
    (issue_id,
    user_id,
    comments,
    comment_time)
    values
    ('$issue_id',
    '$user_id',
    '$comments',
    NOW())";
    
    $run_add_comment = mysqli_query($con,$insert_new_comment);

    if($run_add_comment){
          
        // select the issuer id from issue

        $get_issuer_id = "select * from issues where issue_id = '$issue_id' ";
    
        $run_issuer_id = mysqli_query($con,$get_issuer_id);
        
        $row_issuer_id = mysqli_fetch_array($run_issuer_id);
        
        $issuer_id = $row_issuer_id['issued_by'];

        $assignee_id = $row_issuer_id['assignee'];
              
        $insert_recent_updates = "insert into recent_updates
        (user_id,
        issue_id,
        issuer_id,
        assignee_id,
        date_time_added,
        update_information)
        values
        ('$user_id',
        '$issue_id',
        '$issuer_id',
        '$assignee_id',
        NOW(),
        'added a comment to Issue #')";

        $run_recent_updates = mysqli_query($con,$insert_recent_updates);

        echo "<meta http-equiv='refresh' content='0'>";
          
    }else{
          
        echo "<script>alert('Error Try Again')</script>";

    }
      
  }

}
?>