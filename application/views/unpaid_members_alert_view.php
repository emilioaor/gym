<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<!-- DataTables -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Unpaid Members List
  </div>
  <div class="card-body pl-0 pr-0 pb-0">
    <?php if(!empty($members)): ?>
    <div class="col-md-8 col-sm-12 p-0">
      <form action="<?php echo base_url('unpaid_members_alert_controller');?>" method="post">
         <div class="input-group mb-3 mt-3 input-group-lg">
           <input type="text" name="keyword" class="form-control" placeholder="Search here" aria-label="Search here" aria-describedby="button-addon2">
           <div class="input-group-append">
             <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
           </div>
         </div>
      </form>
    </div>
    <div class="table-responsive ">
      <table class="table table-bordered mb-0" cellspacing="0">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Invoice</th>
            <th>Member ID</th>
            <th>Name</th>
            <th>Plan Name</th>
            <th>Date of Payment</th>
            <th>Total/Paid</th>
            <th>Balance</th>
            <th>Expiry</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>S.No</th>
            <th>Invoice</th>
            <th>Member ID</th>
            <th>Name</th>
            <th>Plan Name</th>
            <th>Date of Payment</th>
            <th>Total/Paid</th>
            <th>Balance</th>
            <th>Expiry</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php  $i = 0;  foreach ($members as $member): ?>
          <?php  $i = ++$i; ?>
            <tr>
              <td><?php echo html_escape($i); ?></td>
              <td><?php echo html_escape($member->member_his_id); ?></td>
              <td><?php echo html_escape($member->member_reg_id); ?>  </td>
              <td><?php echo html_escape($member->member_name); ?> </td>
              <td><?php echo html_escape($member->plan_name); ?></td>
              <td><?php echo html_escape($member->member_his_pay_date); ?></td>
              <td><?php echo ''.html_escape($currecny.$member->plan_total_amount) .'/'. html_escape($currecny).html_escape($member->member_paid_amount); ?> </td>
              <td><?php echo ''.html_escape($currecny).html_escape($member->member_payable_amount); ?></td>
              <td><?php echo html_escape($member->member_his_exp_date); ?></td>
              <td>
                <a href="<?php base_url(); ?>pay_bal_controller/add_bal/<?php echo $member->invoice; ?>"><button type="button" class="btn btn-primary ">Pay Balance</button></a> 
              </td>
            </tr>
          <?php endforeach; ?>   
        </tbody>
      </table>
      <?php if($this->session->has_userdata('key')): ?>
      <?php echo $this->pagination->create_links(); ?>
      <?php $this->session->unset_userdata('key'); ?>
      <?php endif; ?>
    </div>
    <?php else: ?>
      <p class="pl-4">No Data Found</p>
     <?php endif; ?>
  </div>
</div>
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>