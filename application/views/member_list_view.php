<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<!-- DataTables -->
<div class="card mb-3">
  <div class="card-header"><i class="fas fa-table"></i> Member List</div>
  <div class="card-body p-0 ">
    <div class="col-md-8 col-sm-12 p-0">
        <form action="<?php echo base_url('member_list_controller');?>" method="post">
           <div class="input-group mb-3 mt-3 input-group-lg">
             <input type="text" name="keyword" class="form-control" placeholder="Search here" aria-label="Search here" aria-describedby="button-addon2">
             <div class="input-group-append">
               <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
             </div>
           </div>
        </form>
    </div>
    <?php if(!empty($members) > 0): ?>
    <div class="table-responsive ">
      <table class="table table-bordered mb-0"  width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Membership Expiry</th>
            <th>Name</th>
            <th>Address/Contact</th>
            <th>Birthday Date</th>
            <th>Age/Sex</th>
            <th>Date Joined/Plan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
           <th>Membership Expiry</th>
           <th>Name</th>
           <th>Address/Contact</th>
           <th>Birthday Date</th>
           <th>Age/Sex</th>
           <th>Date Joined/Plan</th>
           <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php foreach ($members as $member): ?>
            <tr>
              <td><?php echo html_escape((new \DateTime($member->member_exp_date))->format('d-m-Y')); ?></td>
              <td><?php echo html_escape($member->member_name); ?></td>
              <td><?php echo html_escape($member->member_address) .'/'. html_escape($member->member_contact); ?> </td>
              <td><?php echo html_escape((new \DateTime($member->member_birthday_date))->format('d-m-Y')); ?> </td>
              <td><?php echo html_escape($member->member_age).'/'. html_escape($member->member_sex); ?></td>
              <td><?php echo html_escape((new \DateTime($member->member_join_date))->format('d-m-Y')).'/'. html_escape($member->plan_name); ?></td>
              <td>
               <div class="btn-group" role="group" aria-label="First group">
                  <a href="<?php echo base_url(); ?>new_registration_controller/editMembership/<?php echo $member->member_reg_id ?>" type="button" class="btn btn-warning" title="Edit Membership">Membership</a>

                  <a href="<?php echo base_url(); ?>member_histroy_controller/view_histroy/<?php echo $member->member_reg_id; ?>" type="button" class="btn btn-primary" >Histroy </a>

                  <a href="<?php echo base_url(); ?>new_registration_controller/member_detail/<?php echo $member->member_reg_id ?>" type="button" class="btn btn-warning">Edit</a>

                  <a href="<?php echo base_url(); ?>member_list_controller/delete_mem/<?php echo $member->member_reg_id; ?>" type="button" class="btn btn-danger deleteMem">Delete</a>
                </div>
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
    <?php   else: ?>
    <p class="pl-4"> No Data Available</p>
    <?php   endif; ?>
  </div>
</div>
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>