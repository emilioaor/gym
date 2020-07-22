<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<?php 
if($this->input->post('from'))  
{
   $from =  html_escape($this->input->post('from'));
   $to = html_escape($this->input->post('to'));
}
 ?>
<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
     <i class="fas fa-table"></i>
     Members From : <?php echo  $this->session->userdata('i_from');  ?> To : <?php echo $this->session->userdata('i_to'); ?>
  </div>
  <div class="card-body p-0">
   <?php if(!empty($overview_pay) > 0): ?>
    <div class="col-md-8 col-sm-12 p-0">
        <form action="<?php echo base_url('income_per_month_controller');?>" method="post">
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
            <th>Total/Paid</th>
            <th>Expiry</th>
            <th>Payment Date</th>
            <th>Invoice</th>
          </tr>
        </thead>
        <tfoot>
         <tr>
            <th>S.No</th>
            <th>Membership ID</th>
            <th>Name</th>
            <th>Total/Paid</th>
            <th>Expiry</th>
            <th>Payment Date</th>
            <th>Invoice</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
            $i = 1 ;
            foreach ($overview_pay as $member) 
            {
              $s_ini = $i++ ;
              // $s_ini = $s_ini + $s_end;
              echo '<tr>';
              echo '<td>'.  html_escape($s_ini) .'</td>';
              echo '<td>'. html_escape($member->member_reg_id) .'</td>';
              echo '<td>'. html_escape($member->member_name) .'</td>';
              echo '<td>'.''. html_escape($currecny).html_escape($member->plan_total_amount).'/'.html_escape($currecny).html_escape($member->member_paid_amount).'</td>';
              echo '<td>'. html_escape($member->member_his_exp_date).'</td>';
              echo '<td>'. html_escape($member->member_his_pay_date).'</td>';
              echo '<td>'. html_escape($member->member_his_id).'</td>';
              
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

  <!-- To Count the total paid amount in given date range -->
  <?php 
  $paid = 0;
    foreach ($payment_counts as $payments) 
    {
      $paid =  $payments->member_paid_amount + $paid;
    }
   ?>
  <div class="card-footer">
    <p class="m-0"><strong>Total Payments in This Date Range : <?php echo html_escape($counts); ?></strong></p> <p class="m-0"><strong>Total Income in This Date Range : <?php echo html_escape($currecny);?><?php echo  html_escape($paid); ?></strong></p> 
  </div>
  <?php else: ?>
    <p class="pl-4 pt-2" > No Data Available</p>
  <?php  endif; ?>
</div>
 <?php else: ?>
 <?php redirect('login_controller'); ?>
 <?php endif; ?>