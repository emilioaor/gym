<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Casual Fitness v1.0</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/custom-style.css" rel="stylesheet">

    <!-- birthday Calendar -->
    <link href="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar.min.css" rel="stylesheet">

    <!-- Charts  -->
    <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
  </head>

  <body id="page-top">
    <?php
    // Switch case for breadcrumb
    $s = $this->uri->segment(1);
    switch ($s) 
    {
      case 'new_registration_controller':
          $s =  "Registration";
         
          break;
      case 'payments_controller':
          $s =  "Payment";
       
          break;
      case 'member_list_controller':
          $s =  "Member List";
          break;
      case 'member_histroy_controller':
          $s =  "Member Histroy";
          break;
      case 'edit_invoice_controller':
          $s =  "Edit Ivoice";
          break;
      case 'plan_controller':
          $s =  "Edit Plans";
          break;
      case 'add_plan_controller':
          $s =  "Add Plan";
          break;
      case 'find_members_per_month_controller':
          $s =  "Find Members";
          break;
      case 'members_per_month_controller':
          $s =  "Members";
          break;
      case 'find_income_per_month_controller':
          $s =  "Find Income";
          break;
      case 'income_per_month_controller':
          $s =  "Income";
          break;
      case 'unpaid_members_alert_controller':
          $s =  "Unpaid Members";
          break;
      case 'pay_bal_controller':
          $s =  "Pay Balance";
          break;
      case 'ending_members_controller':
          $s =  "Ending Members";
          break;
      case 'new_payments_controller':
          $s =  "New Payment";
          break;
      case 'layout_controller':
          $s =  "Settings";
          break;
      case 'edit_profile_controller':
          $s =  "Edit Profile";
          break;
      case 'admin_controller':
          $s =  "Home";
          break;

      default:
          $s =  "Home";
          break;
    }
    ?>
    <?php 
    $gym_settings = $this->layout_model->get_gym_settings();
      foreach ($gym_settings as $name) 
      {
        $brand_name = html_escape($name->brand_name);
      }
     ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo base_url(); ?>admin_controller"><?php echo html_escape($brand_name); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item <?php if($s == "Home"){ echo html_escape('active'); } ?>"> 
            <a class="nav-link" href="<?php echo base_url(); ?>admin_controller">Dashboard</a>
          </li>

          <li class="nav-item <?php if($s == "Registration"){ echo html_escape('active'); } ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>new_registration_controller">New Registration</a>
          </li>

          <li class="nav-item <?php if($s == "Payment"){ echo html_escape('active'); } ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>payments_controller">Payments</a>
          </li>

          <li class="nav-item <?php if($s == "Member List"){ echo html_escape('active'); } ?>" >
            <a class="nav-link" href="<?php echo base_url(); ?>member_list_controller">Members</a>
          </li>

          <li class="nav-item dropdown <?php if($s == 'Edit Plans' || $s == 'Add Plan' ){ echo html_escape('active'); } ?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Plan
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?php echo base_url(); ?>add_plan_controller/add_plan">New Plan</a>
              <a class="dropdown-item" href="<?php echo base_url(); ?>plan_controller">Edit Plan</a>
            </div>
          </li>

          <li class="nav-item dropdown <?php if($s == 'Find Income' || $s == 'Find Members' ){ echo html_escape('active'); } ?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Overview
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?php echo base_url(); ?>find_members_per_month_controller">Members per month</a>
              <a class="dropdown-item" href="<?php echo base_url(); ?>find_income_per_month_controller">Income per month</a>
            </div>
          </li>

          <li class="nav-item dropdown <?php if($s == 'Unpaid Members' || $s == 'Ending Members' ){ echo html_escape('active'); } ?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Alert
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" href="<?php echo base_url(); ?>unpaid_members_alert_controller">Unpaid members</a>
             <a class="dropdown-item" href="<?php echo base_url(); ?>ending_members_controller">Ending members</a>
            </div>
          </li>

          <li class="nav-item <?php if($s == "Settings"){ echo html_escape('active'); } ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>layout_controller">Settings</a>
          </li>

        </ul>

        <ul class="navbar-nav  ml-auto  ">

          <li class="nav-item dropdown no-arrow <?php if($s == 'Edit Profile'){ echo 'active'; } ?>">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span><?php echo $this->session->userdata('username'); ?></span>  <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="<?php echo base_url(); ?>edit_profile_controller">Edit Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
          </li>

        </ul>
      </div>
    </nav>
   <!-- Wrapper -->
    <div id="wrapper">
      <div id="content-wrapper">
        <div class="container-fluid">
           <!-- view files here -->
            <?php $this->load->view($main_view); ?> 
         </div>
       </div>
     </div>
     <!-- Sticky Footer -->
    <footer class="sticky-footer ">
      <div class="container my-auto  ">
        <div class="h6 text-center  ">
          <span>Casual Fitness,A Complete GYM Management & Administration System</span>
        </div>
      </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top  rounded" href="#page-top">
      <i class="fas fa-angle-up" ></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?php echo base_url(); ?>user/register_controller/logout_user">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>


    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>assets/js/sb-admin.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

    <!-- Demo scripts for this page-->
    <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>

    <!-- birthday Calendar -->
    <script src="<?php echo base_url(); ?>assets/fullcalendar/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/birthdayCalendar.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
      <script>
        let events = []
        let dateFinal = <?php echo $birthdayDates ?>;
        dateFinal.forEach(data => {
          events.push({
            title: data.title.toUpperCase(),
            text_hover: data.title,
            start: data.start,
            image: data.image,
            color: '#2ecc71',
          });
        })
        birthdayCalendar('#birthdayCalendar', events)
      </script>
  </body>
</html>
