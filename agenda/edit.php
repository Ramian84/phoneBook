<!DOCTYPE html>
<html lang="en">

<head>

<?php
session_start();
$pageTitle = "Agenda - Edit Details ";
require_once('includes/header.php');
require_once('includes/db.php');
require_once('includes/functions.php');



if(isset($_SESSION['username'])){
  $userRole = $_SESSION['role'];
  $userId = $_SESSION['id'];

  if(empty($_POST['submit'])){
    $id=$_GET['editId'];
        
    $selectString = "SELECT names.*,phones.number,phones.label,addresses.street,addresses.building,cities.name FROM names 
                                                LEFT JOIN phones ON names.id=phones.name_id 
                                                LEFT JOIN addresses ON names.id=addresses.name_id 
                                                LEFT JOIN cities ON addresses.city_id=cities.id  
                                                WHERE names.id='$id'";

    $query = mysqli_query($conn,$selectString);
    if(!$query) {
       printf("Error: %s\n", mysqli_error($conn));
        exit;
      }
    $res = mysqli_fetch_assoc($query);
    

  }

  ?>

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php 
        require_once('includes/sidebar.php');
      ?>
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
              <?php 
                require_once('includes/topbar.php');
              ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
           
     
            <!-- Insert New Contact FORM -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact modification</h6>
                   <?php
                      if(isset($mesaj)) {
                         echo $mesaj;
                      } else if(empty($_POST['submit'])) {
                        echo "Please modify the fields you need to change!" ;
                      }
                   ?>

                   
              </div>
              <div class="card-body">
                <div class="">

                  <form class="user" method="post" action="edit_process.php" >
                    
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
                              $selectCity = mysqli_query($conn, $selectCityString);

                                if(!$selectCity) {
                                  printf("Error: %s\n", mysqli_error($conn));
                                  header("Location: editcontact.php?mesaj=2");   
                                  die();
                                }
                    
                              while($res = mysqli_fetch_array($selectCity)) {
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

        <!-- Footer -->
          <?php
           require_once('includes/footer.php');
          ?>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->




    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

  </body>

  </html>
  <?php

} else {
  header('Location: danger.php');
}
?>