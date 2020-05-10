<!DOCTYPE html>
<html lang="en">

<head>

  <?php
    session_start();
    $pageTitle = 'Agenda Login';
    require_once('includes/header.php');
    require_once('includes/db.php');
    $message="";

      if(isset($_POST['submit'])){
        $userName = $_POST['user_name'];
        $password = $_POST['password'];

        $selectUserString = "SELECT * FROM users WHERE user_name= '".$userName."' AND password = md5('".$password."')";
        $selectUserQuery  = mysqli_query($conn,$selectUserString);
        if(!$selectUserQuery) {
          $message = "Invalid Username or Password!";
          die("QUERY FAILED" . mysli_error($conn));
        }
        
        if (mysqli_num_rows($selectUserQuery) == 1){

            while($row = mysqli_fetch_assoc($selectUserQuery)) {
              $db_userId = $row['id'];
              $db_userName = $row['user_name'];
              $db_userPassword = $row['password'];
              $db_userRole = $row['user_role'];
            }

             $_SESSION['id'] = $db_userId;
             $_SESSION['username'] = $db_userName;
             $_SESSION['password'] = $db_userPassword;
             $_SESSION['role'] = $db_userRole;

             header('Location: index.php');            

        }else {

                $message = "Invalid username or password!";

          }

      }


  ?>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome to Agenda App!</h1>
                  </div>
                  <form class="user" method="post" >
                      <div class="message"><?php if($message!="") { echo $message; } ?></div>
                        <div class="form-group">
                          <input type="text" name="user_name" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username...">
                        </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                          <input type="checkbox" class="custom-control-input" id="customCheck">
                          <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                      </div>
                        <input class="btn btn-primary btn-user btn-block" type="submit" name="submit" >
  <!--                     <a href="index.php" class="btn btn-primary btn-user btn-block" name="submit">
                        Login
                      </a> -->
                      <hr>
                      <a href="#" class="btn btn-google btn-user btn-block">
                        <i class="fab fa-google fa-fw"></i> Login with Google
                      </a>
                      <a href="#" class="btn btn-facebook btn-user btn-block">
                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                      </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
