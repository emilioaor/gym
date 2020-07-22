<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"> <i class="fas fa-table"></i> Edit Plan</div>
      <div class="card-body">
        <?php 
            foreach ($plan_details as $plan) 
            {
              $plan_detail = array(
                 'plan_id' => $plan->plan_id,
                 'plan_name' => $plan->plan_name,
                 'plan_details' => $plan->plan_details,
                 'plan_days' => $plan->plan_days,
                 'plan_rate' => $plan->plan_rate 
              );
            }
         ?>
         <?php echo form_open('add_plan_controller/update_plan/'. html_escape($this->uri->segment(3).'')); ?>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Plan id','plan'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'plan',
                      'id' => 'plan',
                      'type' => 'number',
                      'disabled' => true,
                      'value' => html_escape($plan_detail['plan_id']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Name','name'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'plan_name',
                      'id' => 'name',
                      'placeholder' => '',
                      'value' => html_escape($plan_detail['plan_name'])
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Details','details'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'plan_details',
                      'id' => 'details',
                      'placeholder' => '',
                      'value' => html_escape($plan_detail['plan_details'])
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Days','days'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'type' => 'number',
                      'name' => 'plan_days',
                      'id' => 'days',
                      'placeholder' => '',
                      'value' => html_escape($plan_detail['plan_days'])
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Rate','rate'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'plan_rate',
                      'type' => 'number',
                      'id' => 'rate',
                      'placeholder' => '',
                      'value' => html_escape($plan_detail['plan_rate']) 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10"> 
                 <?php 
                    $data = array(
                      'class' => 'btn btn-primary',
                      'name' => 'update_plan',
                      'value' => 'Update'
                    );
                    echo form_submit($data);    
                 ?>
              </div>
            </div>
         <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>