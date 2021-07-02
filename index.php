<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Alpha Water - Login</title>
        <link rel="shortcut icon" type="image/jpg" href="images/favicon-32x32.png"/>
        <link href="css/style.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container mb-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <!-- AlphaWater Logo -->
                                    <img src="images/AlphaWater-logo.jpg" alt="logo">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Account Login</h3></div>
                                    <div class="card-body">
                                        <form action="login_check" method="post">
                                            <div class="form-group">
                                                <label class="small mb-2" for="inputEmailAddress">Email</label>
                                                <input name="email_address" class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Enter email address" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-2" for="inputPassword">Password</label>
                                                <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" required>
                                            </div>
                                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-1">
                                                <button type="submit" class="btn btn-lg btn-primary btn-block" name="user_login">Login</button>
                                            </div>
                                            <div class="card-footer text-center mt-2 pb-0" style="background-color: white; border: none;">
                                                <div class="small"><a href="register">Register New Account</a></div>
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
                            <div class="text-muted text-center" style="margin: 0px auto !important;">AlphaWater - UNIMAS SUSTAINABLE WATER TREATMENT SYSTEM</div>
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


