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

// counting total number of issues

$get_issues = "select * from issues where issued_by = '$user_id'";
    
$run_issues = mysqli_query($con,$get_issues);

$count_issues = mysqli_num_rows($run_issues);

// Pending Issues - representative of community

$pending_issues_counter = 0;

$total_pending_issues = "select * from issues WHERE issued_by = '$user_id' AND current_progress = '1' ";

$run_pending_issues = mysqli_query($con,$total_pending_issues);

while($row_pending_issues=mysqli_fetch_array($run_pending_issues)){

    $pending_issues_counter++;
}

// In Progress Issues - representative of community

$inprogress_issues_counter = 0;

$total_inprogress_issues = "select * from issues WHERE issued_by = '$user_id' AND current_progress = '2' ";

$run_inprogress_issues = mysqli_query($con,$total_inprogress_issues);

while($row_inprogress_issues=mysqli_fetch_array($run_inprogress_issues)){

    $inprogress_issues_counter++;
}

// Completed Issues - representative of community

$completed_issues_counter = 0;

$total_completed_issues = "select * from issues WHERE issued_by = '$user_id' AND current_progress = '3' ";

$run_completed_issues = mysqli_query($con,$total_completed_issues);

while($row_completed_issues=mysqli_fetch_array($run_completed_issues)){

    $completed_issues_counter++;
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
        <title>AlphaWater - Dashboard</title>
        <link rel="shortcut icon" type="image/jpg" href="../images/favicon-32x32.png"/>

        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/main-2.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />   
        <!-- chartjs link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js" integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
        <script>
        window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
	    theme: "light1", // "light1", "light2", "dark1", "dark2"
	    exportEnabled: true,
	    animationEnabled: true,
	    data: [{
		    type: "pie",
		    startAngle: 25,
		    toolTipContent: "<b>{label}</b>: {y}",
		    showInLegend: "true",
		    legendText: "{label}",
		    indexLabelFontSize: 16,
		    indexLabel: "{label} - {y}",
		    dataPoints: [
			    { y: <?php echo $pending_issues_counter; ?>, label: "Pending Review" }, // pending issues total
			    { y: <?php echo $inprogress_issues_counter; ?>, label: "In Progress" }, // in progress issues total
			    { y: <?php echo $completed_issues_counter; ?>, label: "Completed" } // completed issues total
		    ]
	        }]
        });
        chart.render();
        }
        </script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="roc-dashboard">Welcome, <?php echo $user_first_name; ?></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <!-- Logout Section -->
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
                            <a class="nav-link mt-3" href="roc-dashboard">
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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <!-- Issues -->
                            <div class="col-xl-12 col-md-12">
                                <div class="card bg-danger text-white mb-4 shadow-lg">
                                <div class="card-body" style="font-size: 25px;">
                                    Issues Created <span class="float-right"><?php echo $count_issues; ?></span>
                                </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="padding-bottom: 10px !important; border-top: 1px solid rgba(0, 0, 0, 0.125) !important;">
                                        <a class="small text-white stretched-link" href="issues">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Recent Issues -->
                        <div class="card mb-4 shadow-lg">
                            <div class="card-header"><h4>Recent Created Issues</h4></div>
                            <div class="card-body">
                            <div class="limiter">
                            <div class="container-table section-scroll" style="height: 375px !important;">
                            <div class="limiter">
				                <div class="table100">
					                <table>
						                <thead>
							                <tr class="table100-head">
								                <th class="column1">Issue Title</th>
								                <th class="column2">Date/Time Issued</th>
								                <th class="column3">Issued By</th>
								                <th class="column4">Priority</th>
								                <th class="column5">Status</th>
								                <th class="column6">Action</th>
							                </tr>
						                </thead>
						                <tbody>
                                            <?php
                                                
                                                // getting recent issues

                                                $get_issues = "select * from issues where issued_by = '$user_id' ORDER BY 1 DESC";
    
                                                $run_issues = mysqli_query($con,$get_issues);
    
                                                while($row_issues = mysqli_fetch_array($run_issues)){

                                                    $issue_id = $row_issues['issue_id'];

                                                    $issue_title = $row_issues['issue_title'];

                                                    $date_added = new DateTime($row_issues['date_added']);

                                                    $date_added_formatted = date_format($date_added, "d F Y - h:i A");

                                                    $issued_by = $row_issues['issued_by'];

                                                    $priority = $row_issues['priority'];

                                                    $current_progress = $row_issues['current_progress'];

                                                    $get_issuer = "select * from users where user_id ='$issued_by'";

                                                    $run_issuer = mysqli_query($con,$get_issuer);

                                                    while($row_issuer = mysqli_fetch_array($run_issuer)){

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
                                                
                                                                $status_name = $row_status['status_name'];

                                            ?>
								            <tr>
									            <td class="column1"><a href="issues-detailed?issue_detailed=<?php echo $issue_id; ?>"><?php echo $issue_title; ?></a></td>
									            <td class="column2"><?php echo $date_added_formatted ; ?></td>
									            <td class="column3"><?php echo $issuer_first_name; ?> <?php echo $issuer_last_name; ?></td>
                                                <?php
                                                if($priority_id=="1"){ // priority 1 = low
                        
                                                    echo "<td class='column4'><a class='btn btn-success btn-sm' style='color: white;'>$priority_name</a></td>";

                                                }
                                                else if($priority=="2"){ // priority 2 = medium

                                                    echo "<td class='column4'><a class='btn btn-warning btn-sm' style='color: white;'>$priority_name</a></td>";

                                                }
                                                else if($priority=="3"){ // priority 3 - high

                                                    echo "<td class='column4'><a class='btn btn-danger btn-sm' style='color: white;'>$priority_name</a></td>";

                                                }else if($priority=="100"){ // priority 100 - No Priority

                                                    echo "<td class='column4'><a style='color: black;'>$priority_name</a></td>";

                                                }
                                                ?>
									            <td class="column5"><?php echo $status_name; ?></td>
									            <td class="column6"><a class="btn btn-primary btn-sm" href="issues-detailed?issue_detailed=<?php echo $issue_id; ?>">View Issue</td>
								            </tr>

                                            <?php } } } } ?>
						                </tbody>
					                </table>
				                </div>
	                        </div>
                            </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Analytical Charts -->
                            <div class="col-xl-6">
                                <div class="card mb-4 shadow-lg">
                                    <div class="card-header"><h4>Issue Analytics</h4></div>
                                    <div class="card-body chart-area">
                                        <div id="chartContainer" style="height: 450px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Updates -->
                            <div class="col-xl-6">
                                <div class="card mb-4 shadow-lg">
                                    <div class="card-header"><h4>Recent Updates</h4></div>
                                    <div class="recent-issues">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12 right">
                                                    
                                                    <?php

                                                        $get_recent_updates = "select * from recent_updates where issuer_id = '$user_id' and user_id != '$user_id' ORDER BY 1 DESC";
    
                                                        $run_recent_updates = mysqli_query($con,$get_recent_updates);

                                                        while($row_recent_updates = mysqli_fetch_array($run_recent_updates)){

                                                        $user_id = $row_recent_updates['user_id'];

                                                        $issue_id = $row_recent_updates['issue_id'];

                                                        $date = new DateTime($row_recent_updates['date_time_added']);

                                                        $date_formatted = date_format($date, "l - d F Y");

                                                        $time = new DateTime($row_recent_updates['date_time_added']);

                                                        $time_formatted = date_format($time, "h:i A");
                                                        
                                                        $update_information = $row_recent_updates['update_information'];

                                                            $get_user_update = "select * from users where user_id ='$user_id'";

                                                            $run_user_update = mysqli_query($con,$get_user_update);
    
                                                            while($row_user_update = mysqli_fetch_array($run_user_update)){
    
                                                                $user_update_first_name = $row_user_update['first_name'];
    
                                                                $user_update_last_name = $row_user_update['last_name'];
                                                                
                                                                echo "
                                                                    
                                                                <div class='box shadow rounded bg-white mb-3'>
                                                                    
                                                                    <div class='box-title border-bottom p-3'>
                                                                        
                                                                        <h6 class='m-0'> $date_formatted </h6>
                                                                    
                                                                    </div>
                                                                
                                                                    <div class='box-body p-0'>
                                                                        
                                                                        <div class='p-3 d-flex align-items-center border-bottom osahan-post-header'>
                                                                            
                                                                            <div class='font-weight-bold mr-3'>
                                                                        
                                                                            <div class='small'><b> $user_update_first_name  $user_update_last_name </b>  $update_information<a href='issues-detailed?issue_detailed=$issue_id'><b>$issue_id</b></a> <span style='color: grey; font-size: 11.5px;'>($time_formatted) </span></div>
                                                                        
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                            </div>
                                                                ";

                                                            } } 

                                                    ?>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            
            // Allowing Notification API

            if(Notification.permission === "granted"){

            console.log(permission);

            }else if(Notification.permission !== "denied"){

            Notification.requestPermission().then(permission =>{

                if(permission === "granted"){

                    console.log(permission);

                }

            });

            }

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

<?php } ?>