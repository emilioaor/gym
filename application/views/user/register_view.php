<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Casual Fitness  - Register</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <?php echo validation_errors(); ?>
        <!-- <form> -->
          <?php echo form_open('user/register_controller/register_user'); ?>
               <div class="form-group">
                 <div class="form-row">
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <?php 
                          $data = array(
                            'class' => 'form-control',
                            'name' => 'firstname',
                            'id' => 'firstName',
                            'placeholder' => 'First Name',
                            'autofocus' => 'autofocus' 
                          );
                          echo form_input($data);
                          echo form_label('First Name','firstName');
                       ?>
                       </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-label-group">
                       <?php 
                           $data = array(
                             'class' => 'form-control',
                             'name' => 'lastname',
                             'id' => 'lastName',
                             'placeholder' => 'Last Name'
                           );
                           echo form_input($data);
                           echo form_label('Last Name','lastName');
                        ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="form-label-group">
                    <?php 
                     $data = array(
                      'class' => 'form-control',
                      'id' => 'inputEmail',
                      'placeholder' => 'Email Address',
                      'name' => 'useremail'
                     );
                     echo form_input($data);
                     echo form_label('Email address','inputEmail');
                     ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-label-group">
                       <?php 
                           $data = array(
                             'class' => 'form-control',
                             'name' => 'password',
                             'id' => 'inputPassword',
                             'placeholder' => 'Password' 
                           );
                           echo form_password($data);
                           echo form_label('Password','inputPassword');
                        ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-label-group">
                        <?php 
                            $data = array(
                            'class' => 'form-control',
                            'name' => 'confirmpassword',
                            'id' => 'confirmPassword',
                            'placeholder' => 'Confirm Password'
                          );
                          echo form_password($data);
                          echo form_label('Confirm Password','confirmPassword');
                         ?>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="form-group">
                  <?php 
                    $data = array(
                      'class' => 'btn btn-primary  btn-block',
                      'name' => 'register_user',
                      'value' => 'Register'
                    );
                    echo form_submit($data);
                   ?>
                </div>
          <?php echo form_close(); ?>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo base_url(); ?>login_controller">Login Page</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
