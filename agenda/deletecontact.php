<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  session_start();
    $pageTitle = "Agenda - Delete Contact "; 
  require_once('includes/header.php');
  require_once('includes/functions.php');

    if (isset($_GET['mesaj']) && $_GET['mesaj'] != ""){
      $mesaj = displayErrorMessage($_GET['mesaj']);

      if (isset($_GET['errors']) &&  $_GET['errors']>0 ){
        $mesaj = $mesaj."Au fost in total ".$_GET['errors']." erori <br>";
      }
    }

  if(isset($mesaj)){
    $mesaj = strtoupper($mesaj);
  }


if(isset($_SESSION['username'])){

  require_once('includes/db.php');
  $userRole = $_SESSION['role'];


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
         
          <!--PHP code to execute for DataTables -->
            <?php

              if($_SESSION['role'] === 'admin') {

                $sqlString = "SELECT users.*,names.*,phones.label,phones.number,addresses.street, addresses.building,cities.name FROM `users`
                                       LEFT JOIN names ON users.id=names.user_id
                                       LEFT JOIN phones ON names.id=phones.name_id
                                       LEFT JOIN addresses ON names.id=addresses.name_id
                                       LEFT JOIN cities ON addresses.city_id=cities.id
                                       ORDER BY names.id";
              } else {

                  $sqlString = "SELECT users.*,names.*,phones.label,phones.number,addresses.street, addresses.building,cities.name FROM `users`
                                       LEFT JOIN names ON users.id=names.user_id
                                       LEFT JOIN phones ON names.id=phones.name_id
                                       LEFT JOIN addresses ON names.id=addresses.name_id
                                       LEFT JOIN cities ON addresses.city_id=cities.id
                                       WHERE users.id=".$_SESSION['id']." 
                                       ORDER BY names.id";
              }

              $query = mysqli_query($conn,$sqlString);

              if(!$query) {
                printf("Error: %s\n", mysqli_error($conn));
                exit;
              }

              $res = mysqli_fetch_assoc($query);

            ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Choose contact to delete</h6>

                <?php
                  if(isset($mesaj)) {
                  echo "<h6>".$mesaj."</h6>";
                  }
                ?>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Phone No.</th>
                      <th>Phone Type</th>
                      <th>Street</th>
                      <th>No</th>
                      <th>City</th>
                      <?php
                         if($userRole === 'admin'){ 
                              echo"<th>User</th>";
                            }
                        ?>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>

                  </tfoot>
                  <tbody>
                    <?php  
                      while($res = mysqli_fetch_assoc($query)){; 
                    ?>  
                      <tr>
                        <td><?php echo $res['first_name'];?></td>
                        <td><?php echo $res['last_name'];?></td>
                        <td><?php echo $res['number'];?></td>
                        <td><?php echo $res['label'];?></td>
                        <td><?php echo $res['street'];?></td>
                        <td><?php echo $res['building'];?></td>
                        <td><?php echo $res['name'];?></td>
                        <?php 
                            if($userRole === 'admin'){ 
                              echo"<td>".$res['user_name']."</td>";
                            }
                        ?>
                        <td><a class="text-danger" data-toggle="modal" data-target="#deleteModal" href="delete.php?deleteID=<?php echo $res['id'];?>">delete</a> </td>
                      </tr>
                     <?php 
                        }
                     ?>
                             
                  </tbody>
                </table>
              </div>
            </div>
          </div>

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

  <!-- Delete Modal-->

  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Delete Contact?</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
             </button>
        </div>
        <div class="modal-body">Select "Delete" below if you are sure you want to delete this user.<div><br>
          <div class="modal-footer">
           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="delete.php?deleteID=<?php echo $res['id'];?>">Delete</a>
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