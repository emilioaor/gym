<?php if($this->session->userdata('is_logged_in')): ?>

<!-- DataTables -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Add Payments
  </div>
  <div class="card-body p-0">
    <div class="col-md-8 col-sm-12 p-0 ">
      <form action="<?php echo base_url('payments_controller');?>" method="post">
         <div class="input-group mb-3 mt-3 input-group-lg">
           <input type="text" name="keyword" class="form-control" placeholder="Search here" aria-label="Search here" aria-describedby="button-addon2">
           <div class="input-group-append">
             <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
           </div>
         </div>
      </form>
    </div>
    <?php if(!empty($members) > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered mb-0" cellspacing="0">
        <thead>
          <tr>
            <th>Plan Expiry</th>
            <th>Name</th>
            <th>Address / Contact</th>
            <th>Proof</th>
            <th>Age / Sex</th>
            <th>Height/Weight</th>
            <th>Date Joined/Plan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
           <th>Membership Expiry</th>
           <th>Name</th>
           <th>Address / Contact</th>
           <th>Proof</th>
           <th>Age / Sex</th>
           <th>Height/Weight</th>
           <th>Date Joined/Plan</th>
           <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
            foreach ($members as $member) 
            {
              echo '<tr>';
              echo '<td>'. html_escape($member->member_exp_date) .'</td>';
              echo '<td>'. html_escape($member->member_name) .'</td>';
              echo '<td width="200">'. html_escape($member->member_address) .' / '. html_escape($member->member_contact) .'</td>';
              echo '<td>'. html_escape($member->member_proof) .'</td>';
              echo '<td>'. html_escape($member->member_age). ' / ' . html_escape($member->member_sex) .'</td>';
              echo '<td>'. html_escape($member->member_height).' inch / '. html_escape($member->member_weight) .' kg</td>';
              echo '<td>'. html_escape($member->member_join_date). ' / ' . html_escape($member->plan_name) .'</td>';
              echo '<td><a href="'.   base_url() .'new_payments_controller/show_member/'. $member->member_reg_id .'"><button type="button" class="btn btn-primary ">Add Payment</button></a></td>';
              echo '</tr>';
            }
           ?>	 
        </tbody>
      </table>
      <?php if($this->session->has_userdata('key')): ?>
      <?php echo $this->pagination->create_links(); ?>
      <?php $this->session->unset_userdata('key'); ?>
      <?php endif; ?>
      </div>
      <?php  else: ?>
      <p class="pl-4"> No Data Available</p>
      <?php endif; ?>
  </div>
</div>
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>