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

    $output = '';
    
    if(isset($_POST["query"])){

    $search = mysqli_real_escape_string($con,$_POST["query"]);
    $query = "
        SELECT * FROM issues
        WHERE issue_id LIKE '%".$search."%'
        OR project_id LIKE '%".$search."%' 
        OR issue_title LIKE '%".$search."%' 
        OR assignee LIKE '%".$search."%'
        OR priority LIKE '%".$search."%'
        OR current_progress LIKE '%".$search."%'
        ";
    }
    else
    {
    $query = "
        SELECT * FROM issues WHERE issued_by = '$user_id' ORDER BY 1 desc
        ";
    }
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
        <div class="row header">
            <div class="cell">
                Issue ID
            </div>
            <div class="cell">
                Project
            </div>
            <div class="cell">
                Title
            </div>
            <div class="cell">
                Date/Time Issued
            </div>
            <div class="cell">
                Assigned To
            </div>
            <div class="cell">
                Priority
            </div>
            <div class="cell">
                Status
            </div>
        </div>
        ';
    while($row = mysqli_fetch_array($result))
    {

    //Getting Project Name
    $project_id = $row["project_id"];

    $get_project = "select * from projects where project_id ='$project_id' ";
        
    $run_project = mysqli_query($con,$get_project);
        
    while($row_project=mysqli_fetch_array($run_project)){
    
        $project_name = $row_project['project_name'];
    
        //Getting Assignee Name
        $assignee_id = $row["assignee"];

        $get_assignee = "select * from users where user_id ='$assignee_id' ";
        
        $run_assignee = mysqli_query($con,$get_assignee);
        
            while($row_assignee=mysqli_fetch_array($run_assignee)){
    
            $assignee_first_name = $row_assignee['first_name'];
    
            $assignee_last_name = $row_assignee['last_name'];

            $date_added = new DateTime($row["date_added"]);

            $date_added_formatted = date_format($date_added, "d F Y - h:i A");

            $priority = $row['priority'];

            $get_priority = "select * from priority where priority_id ='$priority'";

            $run_priority = mysqli_query($con,$get_priority);

            while($row_priority = mysqli_fetch_array($run_priority)){

                $priority_id = $row_priority['priority_id'];

                $priority_name = $row_priority['priority_name'];

                $current_progress = $row['current_progress'];

                $get_status = "select * from status where status_id ='$current_progress'";

                $run_status = mysqli_query($con,$get_status);
    
                while($row_status = mysqli_fetch_array($run_status)){
    
                    $status_id = $row_status['status_id'];
    
                    $status_name = $row_status['status_name'];

                
            if($row["priority"]=="1"){ // priority low
                        
                $output .= '
                <div class="row" style="border-bottom: 25px solid #f2f2f2 !important;">
                    <div class="cell" data-title="Issue ID">
                        '.$row["issue_id"].'
                    </div>
                    <div class="cell" data-title="Project">
                        '.$project_name.'
                    </div>
                    <div class="cell" data-title="Title">
                    <a href="issues-detailed?issue_detailed='.$row["issue_id"].'"> '.$row["issue_title"].' </a>
                    </div>
                    <div class="cell" data-title="Date/Time Issued">
                        '.$date_added_formatted.'
                    </div>
                    <div class="cell" data-title="Assigned To">
                        '.$assignee_first_name.' '.$assignee_last_name.' 
                    </div>
                    <div class="cell" data-title="Priority"> 
                        <a class="btn btn-success btn-sm" style="color: white;">'.$priority_name.'</a>
                    </div>
                    <div class="cell" data-title="Status">
                        '.$status_name.'
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-outline-secondary btn-block my-3 mx-4" href="issues-detailed?issue_detailed='.$row["issue_id"].'" role="button">View Issue</a>
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-success btn-block my-3 mx-4" href="edit_issue?edit_issue='.$row["issue_id"].'" role="button">Edit Issue</a>
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-primary btn-block my-3 mx-4" href="issues-detailed?issue_detailed='.$row["issue_id"].'" role="button">Comments</a>
                    </div>
                </div>
                ';

            } 
            else if($row["priority"]=="2"){ // priority medium

                $output .= '
                <div class="row" style="border-bottom: 25px solid #f2f2f2 !important;">
                    <div class="cell" data-title="Issue ID">
                        '.$row["issue_id"].'
                    </div>
                    <div class="cell" data-title="Project">
                        '.$project_name.'
                    </div>
                    <div class="cell" data-title="Title">
                    <a href="issues-detailed?issue_detailed='.$row["issue_id"].'"> '.$row["issue_title"].' </a>
                    </div>
                    <div class="cell" data-title="Date/Time Issued">
                        '.$date_added_formatted.'
                    </div>
                    <div class="cell" data-title="Assigned To">
                        '.$assignee_first_name.' '.$assignee_last_name.' 
                    </div>
                    <div class="cell" data-title="Priority">
                        <a class="btn btn-warning btn-sm" style="color: white;">'.$priority_name.'</a>
                    </div>
                    <div class="cell" data-title="Status">
                        '.$status_name.'
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-outline-secondary btn-block my-3 mx-4" href="issues-detailed?issue_detailed='.$row["issue_id"].'" role="button">View Issue</a>
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-success btn-block my-3 mx-4" href="edit_issue?edit_issue='.$row["issue_id"].'" role="button">Edit Issue</a>
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-primary btn-block my-3 mx-4" href="issues-detailed?issue_detailed='.$row["issue_id"].'" role="button">Comments</a>
                    </div>
                </div>
                ';
            } 
            else if($row["priority"]=="3"){ // priority high

                $output .= '
                <div class="row" style="border-bottom: 25px solid #f2f2f2 !important;">
                    <div class="cell" data-title="Issue ID">
                        '.$row["issue_id"].'
                    </div>
                    <div class="cell" data-title="Project">
                        '.$project_name.'
                    </div>
                    <div class="cell" data-title="Title">
                    <a href="issues-detailed?issue_detailed='.$row["issue_id"].'"> '.$row["issue_title"].' </a>
                    </div>
                    <div class="cell" data-title="Date/Time Issued">
                        '.$date_added_formatted.'
                    </div>
                    <div class="cell" data-title="Assigned To">
                        '.$assignee_first_name.' '.$assignee_last_name.' 
                    </div>
                    <div class="cell" data-title="Priority">
                        <a class="btn btn-danger btn-sm" style="color: white;">'.$priority_name.'</a>
                    </div>
                    <div class="cell" data-title="Status">
                        '.$status_name.'
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-outline-secondary btn-block my-3 mx-4" href="issues-detailed?issue_detailed='.$row["issue_id"].'" role="button">View Issue</a>
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-success btn-block my-3 mx-4" href="edit_issue?edit_issue='.$row["issue_id"].'" role="button">Edit Issue</a>
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-primary btn-block my-3 mx-4" href="issues-detailed?issue_detailed='.$row["issue_id"].'" role="button">Comments</a>
                    </div>
                </div>
                ';

            }else if($row["priority"]=="100"){

                $output .= '
                <div class="row" style="border-bottom: 25px solid #f2f2f2 !important;">
                    <div class="cell" data-title="Issue ID">
                        '.$row["issue_id"].'
                    </div>
                    <div class="cell" data-title="Project">
                        '.$project_name.'
                    </div>
                    <div class="cell" data-title="Title">
                    <a href="issues-detailed?issue_detailed='.$row["issue_id"].'"> '.$row["issue_title"].' </a>
                    </div>
                    <div class="cell" data-title="Date/Time Issued">
                        '.$date_added_formatted.'
                    </div>
                    <div class="cell" data-title="Assigned To">
                        '.$assignee_first_name.' '.$assignee_last_name.' 
                    </div>
                    <div class="cell" data-title="Priority">
                        <a style="color: black;">'.$priority_name.'</a>
                    </div>
                    <div class="cell" data-title="Status">
                        '.$status_name.'
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-outline-secondary btn-block my-3 mx-4" href="issues-detailed?issue_detailed='.$row["issue_id"].'" role="button">View Issue</a>
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-success btn-block my-3 mx-4" href="edit_issue?edit_issue='.$row["issue_id"].'" role="button">Edit Issue</a>
                    </div>
                    <div id="my-content" class="cell-hidden">
                        <a class="btn btn-primary btn-block my-3 mx-4" href="issues-detailed?issue_detailed='.$row["issue_id"].'" role="button">Comments</a>
                    </div>
                </div>
                ';

            }


 }
}}}}
 echo $output;
}
else
{
    echo '<div style="text-align: center; margin: 50px auto;"> <h2>Issue Not Found!</h2> </div>';
}
}
?>