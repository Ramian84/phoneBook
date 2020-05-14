  <?php
  $pageTitle = "Agenda - Dashboard "; 
  require_once('includes/config.php');
  require_once('includes/header.php');
    
  checkUserLogin();
  
  $userRole = $_SESSION['role'];
  $userId   = $_SESSION['id'];
  
  if (isset($_GET['mesaj']) && $_GET['mesaj'] != ""){
      $mesaj = getErrorMessage($_GET['mesaj']);
      
      if (isset($_GET['errors']) &&  $_GET['errors']>0 ){
          $mesaj = $mesaj."Au fost in total ".$_GET['errors']." erori <br>";
      }
      
      $mesaj = strtoupper($mesaj);
  }
  

   
    
  ?>


<body id="page-top">

  <!-- Custom styles for Contacts page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


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
            <?php 
              require_once 'includes/topbar.php';
            ?>
            </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
         
          <!--PHP code to execute for DataTables -->
            <?php

              $selectContactString = "SELECT u.*,c.*,ph.label,ph.number,addr.street,addr.building,cities.name FROM `users` AS u
                                       LEFT JOIN contacts AS c ON u.id=c.user_id
                                       LEFT JOIN contact_phones AS ph ON c.id=ph.contact_id
                                       LEFT JOIN contact_addresses AS addr ON c.id=addr.contact_id
                                       LEFT JOIN cities ON addr.city_id=cities.id
                                       WHERE u.id=".$_SESSION['id']." 
                                       ORDER BY c.id";
         

              $query = mysqli_query($conn,$selectContactString);

              if(!$query) {
                printf("Error: %s\n", mysqli_error($conn));
                exit;
              }

              $res = mysqli_fetch_assoc($query);

            ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="exportContacts.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export contacts .csv format</a>
              <?php if(isset($mesaj)) {
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
                       <th>Edit</th>
                       <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
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
                      <th>Edit</th>
                      <th>Delete</th>  
                      
                    </tr>
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
                        <td><a class="text-danger" href="editContactForm.php?id=<?php echo $res['id'];?>">edit</a> </td>
                        <td><a class="text-danger" href="deleteContact.php?id=<?php echo $res['id'];?>">delete</a> </td> 
                      
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
        <?php   require_once('includes/footer.php');  ?>
      <!-- End of Footer -->

