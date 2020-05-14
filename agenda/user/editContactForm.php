<?php

$pageTitle = "Agenda - Edit Contact Details ";
require_once('includes/header.php');
require_once('includes/config.php');
checkUserLogin();

  $contactId = $_GET['id'];
  
  $actionAuthorId = $_SESSION['id'];
  $userId         = $_SESSION['id'];
  
  $contactAuthorId = "SELECT user_id FROM contacts WHERE id=$contactId";
  $contactAuthorIdQuery = mysqli_query($conn,$contactAuthorId);
  if(!$contactAuthorIdQuery){
      echo "Error:".mysqli_error($conn);
      
  }
  $res = mysqli_fetch_assoc($contactAuthorIdQuery);
  $contactAuthorIdResult = $res['user_id'];
  
  if($contactAuthorIdResult != $actionAuthorId) {
      
      header("Location: 404.php");
      die();
      
  }
  
  
  

  if(empty($_POST['submit'])){
    $id=$_GET['id'];
        
    $selectContactString = "SELECT c.*,ph.number,ph.label,addr.street,addr.building,cities.name 
                                                FROM contacts AS c 
                                                LEFT JOIN contact_phones AS ph ON c.id=ph.contact_id 
                                                LEFT JOIN contact_addresses AS addr ON c.id=addr.contact_id 
                                                LEFT JOIN cities ON addr.city_id=cities.id  
                                                WHERE c.id='$id'";

    $selectContactQuery = mysqli_query($conn,$selectContactString);
    if(!$selectContactQuery) {
        echo "Error: ".mysqli_error($conn);
        exit;
      }
      $res = mysqli_fetch_assoc($selectContactQuery);
    

  }

  ?>

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php  require_once('includes/sidebar.php'); ?>
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
              <?php  require_once('includes/topbar.php');  ?>
             </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
           
     
            <!-- Insert New Contact FORM -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Contact details</h6>
                   <?php
                      if(isset($mesaj)) {
                         echo $mesaj;
                      } else if(empty($_POST['submit'])) {
                        echo "Please modify the fields you need to change!" ;
                      }
                   ?>

                   
              </div>
              <div class="card-body">
                <div class="col-md-6">

                  <form class="user" method="post" action="editContact_process.php" >
                    
                      <input class="form-control form-control" type="hidden" name="nameId" value="<?php echo $id;?>" >
                      <input class="form-control form-control" type="text" name="firstName" value="<?php echo $res['first_name']; ?>"> <br>
                      <input class="form-control form-control" type="text" name="lastName" value="<?php echo $res['last_name']; ?>" ><br>
                      <input class="form-control form-control" type="text" name="telephone" value="<?php echo $res['number']; ?>"><br>
                      <input class="form-control form-control" type="text" name="label"  value="<?php echo $res['label']; ?>"><br>
                      <input class="form-control form-control" type="text" name="street" value="<?php echo $res['street']; ?>"><br>
                      <input class="form-control form-control" type="text" name="building" value="<?php echo $res['building']; ?>"><br>
                      <select class="form-control form-control" name="cityId">
                        <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>
                            <?php 
                              $selectCityString = "SELECT * FROM cities ORDER BY name";
                              $selectCityQuery = mysqli_query($conn, $selectCityString);

                              if(!$selectCityQuery) {
                                  printf("Error: %s\n", mysqli_error($conn));
                                  header("Location: index.php?mesaj=2");   
                                  die();
                                }
                    
                                while($res = mysqli_fetch_array($selectCityQuery)) {
                            ?>

                          <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>
                            <?php
                                  } 
                            ?>
                        
                      </select><br>

                      <input class="btn btn-primary btn-user btn-block" type="submit" name="submit" value="Edit Contact"><br>
                    
                  </form>

                  
                </div>
              </div>
            </div>
            <!-- End FORM -->

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

 <!-- Footer -->
  <?php    require_once('includes/footer.php');  ?>
 <!-- End of Footer -->
  