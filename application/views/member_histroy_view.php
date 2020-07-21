<?php if($this->session->userdata('is_logged_in')): ?>

<!-- To get the name of member  -->
<?php 
foreach ($member_details as  $member) {
  $member_data = array(
    'member_name' => $member->member_name,
   );
} 
?>

 <!-- DataTables -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
  	Details of : <?php echo  html_escape($member_data['member_name']); ?></div>
  <div class="card-body  p-0">
    <div class="table-responsive">
      <table class="table table-bordered m-0 "    width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Image</th>
            <th>Membership ID</th>
            <th>Name</th>
            <th>Age/Sex</th>
            <th>Join On</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Image</th>
            <th>Membership ID</th>
            <th>Name</th>
            <th>Age/Sex</th>
            <th>Join On</th>
          </tr>
        </tfoot>
        <tbody>
            <?php foreach($member_details as $member) : ?>
                <tr>
                  <td>
                    <div class="card card-width">
                      <img src="<?php echo base_url(); ?>images/<?php echo html_escape($member->member_img) ?>" class="card-img-top" alt="No Preview">
                    </div>
                  </td>
                <td> <?php echo html_escape($member->member_reg_id); ?> </td>
                <td> <?php echo html_escape($member->member_name); ?> </td>
                <td> <?php echo html_escape($member->member_age).'/'. html_escape($member->member_sex); ?> </td>
                <td> <?php echo html_escape($member->member_join_date); ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- DataTables -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
  	Details of : <?php echo  html_escape($member_data['member_name']); ?></div>
  <div class="card-body p-0">
    <?php if($member_his_details > 1): ?>
    <div class="table-responsive">
      <table class="table table-bordered  mb-0"    width="100%" cellspacing="0">
        <thead>
          <tr>
          	<th>S.No</th>
            <th>Name</th>
            <th>Membership</th>
            <th>Payment Date</th>
            <th>Total/Paid</th>
            <th>Invoice</th>
            <th>Membership Expiry</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Membership</th>
            <th>Payment Date</th>
            <th>Total/Paid</th>
            <th>Invoice</th>
            <th>Membership Expiry</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
           <?php  $i = 0;  foreach ($member_his_details as $member): ?>
            <?php  $i = ++$i; ?>
                <tr>
                  <td><?php echo html_escape($i); ?></td>
                   <td><?php echo html_escape($member->member_name); ?></td>
                  <td><?php echo html_escape($member->plan_name); ?></td>
                  <td><?php echo html_escape($member->member_his_pay_date); ?></td>
                  <td><?php echo ''.html_escape($currecny).html_escape($member->plan_total_amount).'/'.html_escape($currecny).html_escape($member->member_paid_amount); ?> </td>
                  <td><?php echo html_escape($member->member_his_id); ?></td>
                  <td><?php echo html_escape($member->member_his_exp_date); ?></td>
                  <td>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                      <a href="<?php echo base_url(); ?>print_invoice_controller/print/<?php echo $member->invoice; ?>" type="button" class="btn btn-primary" >Print </a>

                      <a href="<?php echo base_url(); ?>edit_invoice_controller/get_his/<?php echo $member->invoice ?>" type="button" class="btn btn-warning">Edit</a>

                      <a href="<?php echo base_url(); ?>member_histroy_controller/delete_his/<?php echo $member->invoice ?>" type="button" class="btn btn-danger deleteMem" >Delete</a>
                    </div>
                  </td>
                </tr>
           <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <p class="pl-3">No Previous Record Found</p>
    <?php endif; ?>
  </div>
</div>
<?php else:  ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>