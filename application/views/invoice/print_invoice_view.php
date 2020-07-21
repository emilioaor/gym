<!DOCTYPE html>
<html lang="en">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Causal Fitness v1.0</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet"> 
  <link href="<?php echo base_url(); ?>assets/css/custom-style.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <?php 
    foreach ($gym_settings as $settings) 
    {
      $setting = array(
        'brand_name' => $settings->brand_name,
        'brand_dis' => $settings->brand_description,
        'country' => $settings->country_name,
        'city' => $settings->city_name,
        'phone_num' => $settings->phone_num,
        'rule1' => $settings->rule_1,
        'rule2' => $settings->rule_2,
        'rule3' => $settings->rule_3,
        'rule4' => $settings->rule_4,
        'rule5' => $settings->rule_5,
        'rule6' => $settings->rule_6,
        'logo' => $settings->logo_img
      );
    }
  ?>
  <?php 
    if ($invoice_data) 
    {
      foreach ($invoice_data as $data) 
      {
        $mem_data = array(
          'invoice' => $data->invoice,
          'plan_name' => $data->plan_name,
          'member_reg_id' => $data->member_reg_id,
          'plan_details' => $data->plan_details,
          'expiry' => $data->member_his_exp_date,
          'total' => $data->plan_total_amount,
          'paid_amount' => $data->member_paid_amount,
          'payable' => $data->member_payable_amount,
          'member_name' => $data->member_name,
          'invoice_no' => $data->member_his_id
        );    
      }  
    }
  ?>
  <div class="container">
    <div class="card mx-auto mt-4 mb-4 invoice-width">
      <div class="card-header text-center h5">
        INVOICE # <?php echo html_escape($mem_data['invoice_no']); ?>
      </div>
      <div class="card-body ">
        <div class="row">
          <div class="col-md-8">
            <ul class="list-unstyled  ">
              <li><?php if(isset($setting['brand_dis'])){ echo html_escape($setting['brand_dis']); } ?></li>
              <li><?php if(isset($setting['country'])){ echo html_escape($setting['country']); }  ?>, <?php if(isset($setting['city'])){ echo html_escape($setting['city']); }  ?></li>
              <li>Mobile: <?php if(isset($setting['phone_num'])){ echo html_escape($setting['phone_num']); }  ?></li>
            </ul>
          </div>
          <div class="col-md-4">
           <img src="<?php echo base_url();?>images/<?php echo html_escape($setting['logo']); ?>" width="120" class=" float-right"  alt="No Preview">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table  table-striped" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Membership Type</th>
                <th>Member ID / Name</th>
                <th>Details</th>
                <th>Subscription Expiry</th>
              </tr>
            </thead>
            <tbody>
               <tr>
                <td><?php echo html_escape($mem_data['plan_name']); ?></td>
                <td><?php echo html_escape($mem_data['member_reg_id']); ?> / <?php echo html_escape($mem_data['member_name']); ?></td>
                <td width="200"><?php echo html_escape($mem_data['plan_details']); ?></td>
                <td><?php echo html_escape($mem_data['expiry']); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="table-responsive  row">
          <table class="table offset-sm-9 col-md-3 " width="100%" cellspacing="0">
            <tbody>
              <tr>
                <th>Total</th>
                <td><?php echo html_escape($currecny); ?><?php echo html_escape($mem_data['total']); ?></td>
              </tr>
              <tr>
                <th>Paid</th>
                <td><?php echo html_escape($currecny); ?><?php echo html_escape($mem_data['paid_amount']); ?></td>
              </tr>
              <tr>
                <th>Due</th>
                <td><?php echo html_escape($currecny); ?><?php echo html_escape($mem_data['payable']); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="text-center h5  border-bottom border-secondary ">
          <span class="letter-space" >ADDITIONAL NOTES</span>
        </div>
        <?php if(isset($setting['rule1'])): ?>
          <p>1). <?php echo html_escape($setting['rule1']); ?></p>
        <?php endif; ?>
         <?php if(isset($setting['rule2'])): ?>
          <p>2). <?php echo html_escape($setting['rule2']); ?></p>
        <?php endif; ?>
         <?php if(isset($setting['rule3'])): ?>
          <p>3). <?php echo html_escape($setting['rule3']); ?></p>
        <?php endif; ?>
          <?php if(isset($setting['rule4'])): ?>
          <p>4). <?php echo html_escape($setting['rule4']); ?></p>
        <?php endif; ?>
         <?php if(isset($setting['rule5'])): ?>
          <p>5). <?php echo html_escape($setting['rule5']); ?></p>
        <?php endif; ?>
         <?php if(isset($setting['rule6'])): ?>
          <p>6). <?php echo html_escape($setting['rule6']); ?></p>
        <?php endif; ?>
      </div>
      <div class="card-footer text-center ">
        <strong><?php if(isset($setting['brand_name'])){ echo html_escape($setting['brand_name']); } ?></strong>
      </div>

      <?php echo form_open('Print_invoice_controller/redirect'); ?>
      <div class="btn-group-vertical   btn-block p-0 ">
           <button id="btnPrint" type="button" class="btn btn-primary btn-lg d-print-none">Print</button>
           <button type="submit" class="btn btn-default btn-lg d-print-none">Cancel</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>  
</body>
</html>
