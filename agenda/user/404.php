  <?php
  $pageTitle = "Agenda - Dashboard "; 
  require_once('includes/config.php');
  require_once('includes/header.php');
    
  checkUserLogin();

  
      
    
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
        
        <!-- 404 Error Text -->
        
          <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <a href="index.php">&larr; Back to Contacts</a>
          </div>
          <!-- End of 404 content -->
          
        </div> 
       <!-- End of Page Content --> 	

      <!-- Footer -->
        <?php   require_once('includes/footer.php');  ?>
      <!-- End of Footer -->
 
      
</div>
<!--  End of Content Wrapper -->