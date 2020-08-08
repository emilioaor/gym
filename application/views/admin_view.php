<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
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
        <?php foreach ($birthday as $bd): ?>
          <p><?php echo strtoupper( $bd->member_name ) ?></p>
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
      <div id="birthdayCalendar">

          <!-- Calendar -->
          <div class="border border-white">
              <div class="d-flex justify-content-start">
                <?php foreach ($data['calendar'][0] as $wd => $week): ?>
                      <div class="w-100 p-2 bg-dark border border-white">
                          <div class="text-white text-center">
                              <strong><?php echo $wd ?></strong>
                          </div>
                      </div>
                <?php endforeach ?>
              </div>
              <?php foreach ($data['calendar'] as $week): ?>
                  <div class="d-flex justify-content-start">
                      <?php foreach ($week as $day): ?>
                          <div class="w-100 p-2 border border-dark <?php echo $day['members'] ? 'bg-success' : '' ?>">
                              <div class="">
                                  <strong><?php echo $day['day'] ?></strong>
                              </div>

                                <?php foreach ($day['members'] as $member): ?>
                                    <div class="" style="font-size: 14px;">
                                        <small>
                                            <i class="fa fa-birthday-cake"></i>
                                            <?php echo $member->member_name ?>
                                        </small>
                                    </div>
                                <?php endforeach ?>
                          </div>
                      <?php endforeach ?>
                  </div>
              <?php endforeach ?>
          </div>

          <div class="mt-5 ml-2">
              <h5><strong>Next 5 days</strong></h5>

              <table class="table  w-100">
                  <thead>
                    <tr class="bg-dark text-white">
                        <th>Birthday Date</th>
                        <th>Name</th>
                        <th>Address/Contact</th>
                        <th>Age/Sex</th>
                        <th>Age/Sex</th>
                        <th>Membership Expiry</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data['next5days'] as $member): ?>
                        <tr>
                            <td><?php echo \DateTime::createFromFormat('Y-m-d', $member->member_birthday_date)->format('d M') ?></td>
                            <td><?php echo $member->member_name ?></td>
                            <td><?php echo $member->member_address ?>/<?php echo $member->member_contact ?></td>
                            <td><?php echo $member->member_age ?>/<?php echo $member->member_sex ?></td>
                            <td><?php echo $member->member_join_date ?>/<?php echo $member->plan_name ?></td>
                            <td><?php echo $member->member_exp_date ?></td>
                        </tr>
                    <?php endforeach ?>
                  </tbody>
              </table>
          </div>

      </div>
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