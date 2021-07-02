<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register Account</title>
        <link rel="shortcut icon" type="image/jpg" href="images/favicon-32x32.png"/>
        <link href="css/style.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg my-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register New Account</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <!-- First Name -->
                                            <div class="form-group">
                                                <label class="small mb-2" >First Name</label>
                                                <input name="first_name" class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter First Name" required>
                                            </div>
                                            <!-- Last Name-->
                                            <div class="form-group">
                                                <label class="small mb-2">Last Name</label>
                                                <input name="last_name" class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Last Name" required>
                                            </div>
                                            <!-- Email Address -->
                                            <div class="form-group">
                                                <label class="small mb-2">Email Address</label>
                                                <input name="email_address" class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter Email Address" required>
                                            </div>
                                            <!-- Password -->
                                            <div class="form-group">
                                                <label class="small mb-2">Password</label>
                                                <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter Password" required>
                                            </div>
                                            <!-- Confirm Password -->
                                            <div class="form-group">
                                                <label class="small mb-2">Confirm Password</label>
                                                <input name="confirm_password" class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Enter Confirm Password" required>
                                            </div>
                                            <!-- User Type -->
                                            <div class="form-group">
                                                <label class="small mb-2">User Type</label>
                                                <select name="role" class="form-control py-4" required>
                                                    <option value="Sub Contractor">Sub Contractor</option>
                                                    <option value="Representative Of Community">Representative Of Community</option>
                                                  </select>
                                            </div>
                                            <!-- Register Button -->
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-1">
                                                <button type="submit" class="btn btn-lg btn-primary btn-block" name="submit">Register Account</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted text-center" style="margin: 0px auto;">AlphaWater - UNIMAS SUSTAINABLE WATER TREATMENT SYSTEM</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

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

        echo "<script>window.open('register_user','_self')</script>";
              
    }
              
}

?>
