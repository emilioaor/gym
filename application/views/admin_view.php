  <?php if($this->session->userdata('is_logged_in')): ?>
  <?php   
    $total = 0;
    if (!empty($income_per_month)) {
    
    foreach($income_per_month as $value) 
    {
        $total =  $value->member_paid_amount +  $total ;
    }
    }
  ?>
  <!-- Icon Cards-->
 <div class="row">
  <?php if ($birthday): ?>
      <div class="col-xl-12 col-sm-6">
        <div class="alert alert-success alert-dismissible fade show " role="alert">
        <strong>Welcome</strong>
        <p>Today is birthday:</p>
        <?php foreach ($birthday as $data): ?>
          <p><?php echo strtoupper( $data->member_name ) ?></p>
        <?php endforeach; ?>  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      </div>
    <?php endif; ?>  

    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
         
          <div class="card-body-icon">
            <i class="fas fa-fw fa-money-bill-alt"></i>
          </div>
          <div class="mr-5 font-weight-bold"><?php echo html_escape($currecny); ?> <?php  echo number_format($total); ?></div>
          <div class="mr-5">Income This Month</div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('payments_controller'); ?>">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-list"></i>
          </div>
          <div class="mr-5 font-weight-bold"><?php  echo html_escape($total_members); ?></div>
          <div class="mr-5">Total Members</div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href=" <?php echo base_url('member_list_controller'); ?>">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-success o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-link"></i> 
          </div>
          <div class="mr-5 font-weight-bold"><?php  echo html_escape($total_mem_in_month); ?></div>
          <div class="mr-5">Joined This Month</div>
        </div> 
        <a class="card-footer text-white clearfix small z-1" href=" <?php echo base_url('find_members_per_month_controller'); ?>">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-danger o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-calendar-alt"></i>
          </div>
          <?php   
            $curr_date = date('d-m-Y');
            $date = date("F d ,Y", strtotime($curr_date));
           ?>
          <div class="mr-5 font-weight-bold"><?php echo  html_escape($date); ?></div>
          <div class="mr-5"><?php echo html_escape(date("l, h:i A")); ?></div>
        </div>
        
      </div>
    </div>
  </div>  

  <!-- Area Chart Example-->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-chart-area"></i>
      Over All Statistics</div>
    <div class="card-body">
      <canvas id="myChart" width="100%" height="30"></canvas>
    </div>
  </div>
  <?php $this->load->view('charts/charts_view'); ?>
  <!-- Chart View -->

  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-calendar"></i>
      birthday Calendar</div>
    <div class="card-body">
      <div id="birthdayCalendar" width="100%" height="30"></div>
    </div>
  </div>

  <div id="modalBirthdayCalendar" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Birthday of the day</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="imgMember">
          <h4 id="nameMember"></h4>
          <h4 id="dateMember"></h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>