<?php
    
    $pageTitle = "Agenda - Profile "; 
    require_once('includes/config.php');
    require_once('includes/header.php');
    
    checkUserLogin();      
      
    $username = $_SESSION['username'];
    $userId   = $_SESSION['id'];


    $selectUserDetailsString = "SELECT * FROM users_details                                        
                                          WHERE user_id= '".$userId."'";
    
  
    $selectUserDetailsQuery  = mysqli_query($conn,$selectUserDetailsString);
    if(!$selectUserDetailsQuery) {
         die("QUERY FAILED" . mysqli_error($conn));
        }

        $res = mysqli_fetch_assoc($selectUserDetailsQuery);

        $firstName = $res['first_name'];
        $lastName  = $res['last_name'];
        $email     = $res['email'];
        $phone     = $res['phone'];


        if (isset($_GET['mesaj']) && $_GET['mesaj'] != ""){
            $mesaj = getErrorMessage($_GET['mesaj']);
            
            if (isset($_GET['errors']) &&  $_GET['errors']>0 ){
                $mesaj = $mesaj."Au fost in total ".$_GET['errors']." erori <br>";
            }
            
            $mesaj = strtoupper($mesaj);
        }

        // Retrieve from DB profile picture based on User ID
        $profilePictureString = "SELECT * FROM photos WHERE user_id=$userId";
        $profilePictureQuery = mysqli_query($conn,$profilePictureString);
        $result = mysqli_fetch_assoc($profilePictureQuery);
        $profilePicture = $result['filename'];
        
 ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
      <?php  require_once('includes/sidebar.php');  ?>
    <!-- End of Sidebar -->



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

        <!-- Topbar Navbar -->
          <?php  require_once('includes/topbar.php'); ?>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            
          </div>

          <!-- Content Row -->
   
          <!-- CONTENT BODY -->

          <div class="container emp-profile">
            <form method="post" action="editUserForm.php">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="img/<?php echo $profilePicture; ?>" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $firstName. " " .$lastName; ?>
                                    </h5>
                                    <h6>
                                     <?php if(isset($mesaj)) {  echo $mesaj; } ?>                                        
                                    </h6>
                             <br><br><br>     
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="">About</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $username;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $firstName. " " .$lastName; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $email; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $phone; ?></p>
                                            </div>
                                        </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>           
        </div>


          <!-- CONTENT BODY -->

   

     
      <!-- End of Main Content -->

    

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  
  <!-- Footer -->
        <?php  require_once('includes/footer.php');  ?>
  <!-- End of Footer -->

