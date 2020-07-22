<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<!-- DataTables -->
<div class="card mb-3">
  <div class="card-header"><i class="fas fa-table"></i> Members List</div>
  <div class="card-body p-0">
    <?php if($expired_mem):?>
    <div class="table-responsive">
      <table class="table table-bordered m-0"  width="100%" cellspacing="0">
        <thead>
          <tr>
      			<th>S.No</th>
      			<th>Name/Member ID</th>
      			<th>Date of Last Payment</th>
      			<th>Plan Name</th>
      			<th>Total/Paid</th>
      			<th>Balance</th>
      			<th>Expiry</th>
      			<th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>S.No</th>
            <th>Name/Member ID</th>
            <th>Date of Last Payment</th>
            <th>Plan Name</th>
            <th>Total/Paid</th>
            <th>Balance</th>
            <th>Expiry</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
           <?php 
               $i=0;
             foreach ($expired_mem as $members) 
             {
              $i = ++$i;
               echo '<tr>';
               echo '<td>'.html_escape($i).'</td>';
               echo '<td>'.  html_escape($members->member_name). '/' .html_escape($members->member_id) . '</td>';
               echo '<td>'. html_escape($members->member_payment_date) .'</td>';
               echo '<td>'. html_escape($members->plan_name).'</td>';
               echo '<td>'.''.html_escape($currecny).html_escape($members->plan_total_amount). '/'.html_escape($currecny).html_escape($members->member_paid_amount) . '</td>';
               echo '<td>'.''.html_escape($currecny).html_escape($members->member_payable_amount).'</td>';
               echo '<td>'.html_escape($members->member_exp_date).'</td>';
               echo '<td>
                        <a href=" '.base_url().'new_payments_controller/show_member/'.$members->member_reg_id.'" class="btn btn-primary ">Make Payment</a>
                     </td>';
               echo '</tr>';
             }
            ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
        <div class="text-muted pl-4 pt-2 pb-2">No Data Found</div>
    <?php endif; ?> 
  </div>
</div>
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>