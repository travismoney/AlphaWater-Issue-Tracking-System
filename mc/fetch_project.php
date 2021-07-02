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
        SELECT * FROM projects
        WHERE project_id LIKE '%".$search."%'
        OR project_name LIKE '%".$search."%' 
        OR project_description LIKE '%".$search."%' 
        OR date_added LIKE '%".$search."%' 
        OR representative LIKE '%".$search."%'
        ";
    }
    else
    {
    $query = "
        SELECT * FROM projects ORDER BY 1 desc
        ";
    }
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
        <div class="row header">
            <div class="cell">
                Project ID
            </div>
            <div class="cell" style="width: 150px;">
                Project Name
            </div>
            <div class="cell" style="width: 500px;">
                Description
            </div>
            <div class="cell" style="width: 200px;">
                Date/Time Added
            </div>
            <div class="cell">
                Representative Of Community
            </div>
        </div>
        ';
    while($row = mysqli_fetch_array($result))
    {

    $representative_id = $row["representative"];

    $get_representative = "select * from users where user_id ='$representative_id' ";
    
    $run_representative = mysqli_query($con,$get_representative);
    
    while($row_representative=mysqli_fetch_array($run_representative)){

        $first_name = $row_representative['first_name'];

        $last_name= $row_representative['last_name'];

        $date_added = new DateTime($row["date_added"]);

        $date_added_formatted = date_format($date_added, "d F Y - h:i A");

    $output .= '
    <div class="row" style="border-bottom: 25px solid #f2f2f2 !important;">
        <div class="cell" data-title="Project ID">
            <?php echo $project_id; ?>
            '.$row["project_id"].'
        </div>
        <div class="cell" data-title="Project Name" style="width: 150px;">
            <a href="edit_project?edit_project='.$row["project_id"].'"> '.$row["project_name"].' </a>
        </div>
        <div class="cell" data-title="Description" style="width: 500px;">
            '.$row["project_description"].'
        </div>
        <div class="cell" data-title="Date Added" style="width: 200px;">
            '.$date_added_formatted.'
        </div>
        <div class="cell" data-title="Representative Of Community">
            '.$first_name.' '.$last_name.'
        </div>
        <div id="my-content" class="cell-hidden">
            <a class="btn btn-outline-secondary btn-block my-3 mx-4" href="edit_project?edit_project='.$row["project_id"].'" role="button">Edit Project</a>
        </div>
    </div>
    ';
    }
 }
 echo $output;
}
else
{
 echo '<div style="text-align: center; margin: 50px auto;"> <h2>Project Not Found!</h2> </div>';
}
}
?>