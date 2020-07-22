<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<?php 
  if($this->input->post('from'))  
  {
     $from =  html_escape($this->input->post('from'));
     $to = html_escape($this->input->post('to'));
  }    
 ?>
<!-- DataTables  -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Members From : <?php echo  $this->session->userdata('from');  ?> To : <?php echo $this->session->userdata('to'); ?></div>
  <div class="card-body p-0 ">
    <?php   if(!empty($overview_mem) > 0): ?>
    <div class="col-md-8 col-sm-12 p-0">
        <form action="<?php echo base_url('members_per_month_controller');?>" method="post">
           <div class="input-group mb-3 mt-3 input-group-lg">
             <input type="text" name="keyword" class="form-control" placeholder="Search here" aria-label="Search here" aria-describedby="button-addon2">
             <div class="input-group-append">
               <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
             </div>
           </div>
        </form>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered m-0"  width="100%" cellspacing="0">
        <thead>
          <tr>
          	<th>S.No</th>
            <th>Membership ID</th>
            <th>Name</th>
            <th>Age/Sex</th>
            <th>Join On</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          	<th>S.No</th>
            <th>Membership ID</th>
            <th>Name</th>
            <th>Age/Sex</th>
            <th>Join On</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
            $i = 1 ;
            foreach ($overview_mem as $member) 
            {
               $count = $i++ ;
              echo '<tr>';
              echo '<td>'.html_escape($count).'</td>';
              echo '<td>'. html_escape($member->member_reg_id) .'</td>';
              echo '<td>'. html_escape($member->member_name) .'</td>';
              echo '<td>'. html_escape($member->member_age).'/'. html_escape($member->member_sex) .'</td>';
              echo '<td>'. html_escape($member->member_join_date).'</td>';   
            }
           ?>  
        </tbody>
      </table>
      <?php if($this->session->has_userdata('key')): ?>
            <?php echo $this->pagination->create_links(); ?>
            <?php $this->session->unset_userdata('key'); ?>
            <?php endif; ?>
    </div>      
  </div> 
  <div class="card-footer"><strong>Total Members in This Date Range : <?php echo html_escape($counts); ?></strong></div>
  <?php else: ?>
    <p class="pl-4 pt-2" > No Data Available</p>
  <?php endif; ?>
</div>
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>