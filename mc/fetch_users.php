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
        SELECT * FROM users
        WHERE user_id LIKE '%".$search."%'
        OR first_name LIKE '%".$search."%' 
        OR last_name LIKE '%".$search."%' 
        OR email_address LIKE '%".$search."%'
        OR role LIKE '%".$search."%'
        OR date_registered LIKE '%".$search."%'
        ";
    }
    else
    {
    $query = "
        SELECT * FROM users where user_id != '$user_id' and user_id != '100' ORDER BY 1 desc
        ";
    }
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0)
    {
   
        $output .= '
        <div class="row header">
        <div class="cell">
            ID
        </div>
        <div class="cell">
            Name
        </div>
        <div class="cell">
            Email
        </div>
        <div class="cell">
            User Type
        </div>
        <div class="cell">
            Date Registered
        </div>
        <div class="cell">
            Action
        </div>
    </div>
        ';
    while($row = mysqli_fetch_array($result))
    {   
        $date_registered = new DateTime($row["date_registered"]);

        $date_registered_formatted = date_format($date_registered, "d F Y - h:i A");
        
    $output .= '
    <div class="row" style="border-bottom: 25px solid #f2f2f2 !important;">
        <div class="cell" data-title="ID">
            '.$row["user_id"].'
        </div>
        <div class="cell" data-title="Name">
        '.$row["first_name"].'
        '.$row["last_name"].'
        </div>
        <div class="cell" data-title="Email">
        '.$row["email_address"].'
        </div>
        <div class="cell" data-title="User Type">
        '.$row["role"].'
        </div>
        <div class="cell" data-title="Date Registered">
        '.$date_registered_formatted.'
        </div>
        <div class="cell" data-title="Action">
            <a class="btn btn-danger btn-sm" href="users?delete_user='.$row["user_id"].'">
                <i class="fas fa-trash-alt"></i> Delete
            </a>
        </div>
    </div>
    ';
}
 echo $output;
}
else
{
    echo '<div style="text-align: center; margin: 50px auto;"> <h2>User Not Found!</h2> </div>';
}
}
?>