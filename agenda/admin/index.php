  <?php
  $pageTitle = "Agenda - Dashboard "; 
  require_once('includes/config.php');
  require_once('includes/header.php');
    
  checkUserLogin();

 
    
  ?>



<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
      <?php   require_once('includes/sidebar.php');   ?>

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
          
          </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

			</div>
          <!-- Content Row -->
                         
    	</div>
        <!-- /.container-fluid -->
	


      <!-- Footer -->
        <?php   require_once('includes/footer.php');  ?>
      <!-- End of Footer -->
      
         </div> 
      <!-- End of Main Content -->   

