<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Implacables Fitness - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">

        <?php $this->load->view('layouts/alert') ?>
      <div class="card-header">Login</div>
      <div class="card-body">
         <?php echo form_open('user/register_controller/login_user'); ?>
           <div class="form-group">
              <div class="form-label-group">
                <?php
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'useremail',
                      'id' => 'inputEmail',
                      'placeholder' => 'Email / Phone',
                      'autofocus' => 'autofocus'
                    );
                    echo form_input($data);
                    echo form_label('Email / Phone','inputEmail');
                 ?>
              </div>
           </div>
           <div class="form-group">
              <div class="form-label-group">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'userpassword',
                      'id' => 'inputPassword',
                      'placeholder' => 'Password'
                    );
                    echo form_password($data);
                    echo form_label('Password','inputPassword');
                 ?>
              </div>
           </div>
           <div class="form-group">
             <?php 
               $data = array(
                 'class' => 'btn btn-primary  btn-block',
                 'name' => 'login_user',
                 'value' => 'Login'
               );
               echo form_submit($data);
              ?>
           </div>
          <div class="text-center">
            <a class="d-block small mt-3" href=""></a>
          </div>
      </div>
      <ul class="list-group">
</ul>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
