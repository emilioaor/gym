<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>

 <!-- DataTables -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
     Membership Plan
   </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-bordered mb-0"  cellspacing="0">
        <thead>
          <tr>
           <th>S.No</th>
           <th>Membership ID</th>
           <th>Plan Name</th>
           <th>Details</th>
           <th>Days</th>
           <th>Rate</th>
           <th>Action</th>
         </tr>
        </thead>
        <tfoot>
          <tr>
            <th>S.No</th>
            <th>Membership ID</th>
            <th>Plan Name</th>
            <th>Details</th>
            <th>Days</th>
            <th>Rate</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
            $i = 0;
            foreach ($plans as $plan) 
            {
              $i = ++$i;
              echo '<tr>';
              echo '<td>'. html_escape($i) .'</td>';
              echo '<td>'. html_escape($plan->plan_id) .'</td>';
              echo '<td>'. html_escape($plan->plan_name) .'</td>';
              echo '<td width="300">'. html_escape($plan->plan_details).'</td>';
              echo '<td>'. html_escape($plan->plan_days).' days</td>';
              echo '<td>'. html_escape($currecny). html_escape($plan->plan_rate).'</td>';
              echo '<td>
                      <div class="btn-group-vertical"> 
                        <a href="'.base_url().'add_plan_controller/get_plan_by_id/'. $plan->plan_id  .'" class="btn btn-warning btn-sm">Edit Plan</a>
                        <a href="'.base_url().'add_plan_controller/delete_plan/'.$plan->plan_id.'" class="btn btn-danger btn-sm deleteMem"> Delete Plan</a>
                      </div>
                    </td>';
              echo '</tr>';
            }
           ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php else:  ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>