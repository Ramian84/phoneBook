<?php
$pageTitle = "Agenda - Add Contact ";
require_once('includes/config.php');
require_once('includes/header.php');

checkUserLogin();

$userId   = $_SESSION['id'];

  if (isset($_GET['mesaj']) && $_GET['mesaj'] != ""){
      $mesaj = getErrorMessage($_GET['mesaj']);

      if (isset($_GET['errors']) &&  $_GET['errors']>0 ){
        $mesaj = $mesaj."Au fost in total ".$_GET['errors']." erori <br>";
      }
      
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


    $firstName       = $_POST['firstName'];
    $lastName        = $_POST['lastName'];
    $tel             = $_POST['telephone'];
    $label           = $_POST['label'];
    $cityId          = $_POST['cityId'];
    $addressStreet   = $_POST['addressStreet'];
    $addressBuilding = $_POST['addressBuilding'];
    $userId          = $_SESSION['id'];

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
    
        $insertnameString = "INSERT INTO contacts (first_name,last_name,user_id) VALUES ('".$firstName."','".$lastName."','".$userId."');";
        $insert = mysqli_query($conn,$insertnameString);
        
        if(!$insert) {
          printf("Error: %s\n", mysqli_error($conn));
          header("Location: addcontact.php?mesaj=2");    
          die();
        }

           //TODO -- fa si astea
        $nameIdpeCareTocmaiLambagatInDB = mysqli_insert_id($conn);

        
        $insertPhoneString = "INSERT INTO contact_phones (contact_id,`number`,label) VALUES (".$nameIdpeCareTocmaiLambagatInDB.",'".$tel."','".$label."');";
        $insertPhone = mysqli_query($conn,$insertPhoneString);

        if(!$insertPhone) {
          printf("Error: %s\n", mysqli_error($conn));
          header("Location: addcontact.php?mesaj=2");    
          die();
        }


        $insertAddressString = "INSERT INTO contact_addresses (contact_id,city_id,street,building) 
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
      <?php require_once('includes/sidebar.php'); ?>
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
              <?php require_once('includes/topbar.php'); ?>
           </nav>
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
                        echo "Fill the fields below to add new contact! " ;
                      }
                   ?>

                   
              </div>
              <div class="card-body">
                <div class="col-md-6">

                  <form class="col-xs-2" method="post" >
                    
                      <input class="form-control" type="text" name="firstName" placeholder="First Name" value="<?php if (isset($firstName)){echo $firstName;}?>"> <br>
                      <input class="form-control" type="text" name="lastName" placeholder="Last Name" value="<?php if (isset($lastName)){echo $lastName;}?>" ><br>
                      <input class="form-control" type="text" name="telephone" placeholder="Telephone" value="<?php if (isset($tel)){echo $tel;}?>"><br>
                      <input class="form-control" type="text" name="label" placeholder="Mobile/Home/Fax" value="<?php if (isset($label)){echo $label;}?>"><br>
                      <input class="form-control" type="text" name="addressStreet" placeholder="Street" value="<?php if (isset($addressStreet)){echo $addressStreet;}?>"><br>
                      <input class="form-control" type="text" name="addressBuilding" placeholder="No." value="<?php if (isset($addressBuilding)){echo $addressBuilding;}?>"><br>
                      <select class="form-control" name="cityId">
                        <?php  while($res = mysqli_fetch_array($selectCity)) {   ?>

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
  <?php require_once('includes/footer.php');  ?>
<!-- End of Footer -->

    </div>
   <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

