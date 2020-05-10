<!DOCTYPE html>
<html lang="en">

<head>

<?php
session_start();
$pageTitle = "Agenda - Add Contact ";
require_once('includes/header.php');
require_once('includes/db.php');
require_once('includes/functions.php');



if(isset($_SESSION['username'])){
  $userRole = $_SESSION['role'];

  if (isset($_GET['mesaj']) && $_GET['mesaj'] != ""){
      $mesaj = displayErrorMessage($_GET['mesaj']);

      if (isset($_GET['errors']) &&  $_GET['errors']>0 ){
        $mesaj = $mesaj."Au fost in total ".$_GET['errors']." erori <br>";
      }
  }

  if(isset($mesaj)){
    $mesaj = strtoupper($mesaj);
  }
   
   
  $selectCityString = "SELECT * FROM cities ORDER BY name";
  $selectCity = mysqli_query($conn, $selectCityString);

  if(!$selectCity) {
    printf("Error: %s\n", mysqli_error($conn));
    header("Location: addcontact.php?mesaj=2");    
    die();
  }


  $errorsArr = array();

  if(!empty($_POST['submit'])) {


    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $tel = $_POST['telephone'];
    $label = $_POST['label'];
    $cityId = $_POST['cityId'];
    $addressStreet = $_POST['addressStreet'];
    $addressBuilding = $_POST['addressBuilding'];
    $userId = $_SESSION['id'];

    // validari input 
    if ($tel == "" || strlen($tel)<5){
      $errorsArr[] = "Numarul de telefon este invalid. Camp obligatoriu si minim 5 caractere";
    }


    if ($tel != ""){
      if (is_numeric($tel) === false) {
        $errorsArr[] = "Numarul de telefon este invalid. Nu poate contine litere";
      }
    } 

    if (count($errorsArr) == 0){
    
        $insertnameString = "INSERT INTO names (first_name,last_name,user_id) VALUES ('".$firstName."','".$lastName."','".$userId."');";
        $insert = mysqli_query($conn,$insertnameString);
        
        if(!$insert) {
          printf("Error: %s\n", mysqli_error($conn));
          header("Location: addcontact.php?mesaj=2");    
          die();
        }

           //TODO -- fa si astea
        $nameIdpeCareTocmaiLambagatInDB = mysqli_insert_id($conn);

        
        $insertPhoneString = "INSERT INTO phones (name_id,`number`,label) VALUES (".$nameIdpeCareTocmaiLambagatInDB.",'".$tel."','".$label."');";
        $insertPhone = mysqli_query($conn,$insertPhoneString);

        if(!$insertPhone) {
          printf("Error: %s\n", mysqli_error($conn));
          header("Location: addcontact.php?mesaj=2");    
          die();
        }


        $insertAddressString = "INSERT INTO addresses (name_id,city_id,street,building) 
                                              VALUES (".$nameIdpeCareTocmaiLambagatInDB.",".$cityId.",'".$addressStreet."', '".$addressBuilding."');";   
        $insertAddress = mysqli_query($conn,$insertAddressString);

        if(!$insertAddress) {
          printf("Error: %s\n", mysqli_error($conn));
          header("Location: addcontact.php?mesaj=2");    
          die();
        }


        header("Location: addcontact.php?mesaj=1");
        die();
      }
    
    }   


    if (count($errorsArr) > 0){
      for($i=0;$i<count($errorsArr);$i++){
         echo "<span class='error'>".$errorsArr[$i]. " </span>";
      } 
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
                <h6 class="m-0 font-weight-bold text-primary">Add New Contact</h6>
                   <?php
                      if(isset($mesaj)) {
                         echo $mesaj;
                      } else if(empty($_POST['submit'])) {
                        echo "Completati campurile pentru a adauga un contact nou!" ;
                      }
                   ?>

                   
              </div>
              <div class="card-body">
                <div class="">

                  <form class="user" method="post" >
                    
                    
                      <input class="form-control form-control" type="text" name="firstName" placeholder="First Name" value="<?php if (isset($firstName)){echo $firstName;}?>"> <br>
                      <input class="form-control form-control" type="text" name="lastName" placeholder="Last Name" value="<?php if (isset($lastName)){echo $lastName;}?>" ><br>
                      <input class="form-control form-control" type="text" name="telephone" placeholder="Telephone" value="<?php if (isset($tel)){echo $tel;}?>"><br>
                      <input class="form-control form-control" type="text" name="label" placeholder="Mobile/Home/Fax" value="<?php if (isset($label)){echo $label;}?>"><br>
                      <input class="form-control form-control" type="text" name="addressStreet" placeholder="Street" value="<?php if (isset($addressStreet)){echo $addressStreet;}?>"><br>
                      <input class="form-control form-control" type="text" name="addressBuilding" placeholder="No." value="<?php if (isset($addressBuilding)){echo $addressBuilding;}?>"><br>
                      <select class="form-control form-control" name="cityId">
                        <?php
                          while($res = mysqli_fetch_array($selectCity)) {
                        ?>

                        <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>

                        <?php }  ?>
                      
                      </select><br>

                      <input class="btn btn-primary btn-user btn-block" type="submit" name="submit" value="Add New Contact"><br>
                    
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