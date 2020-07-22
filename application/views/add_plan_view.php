<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"><i class="fas fa-table"></i> Add Plan</div>
      <div class="card-body">
        <!-- Form starts -->
         <?php echo form_open('add_plan_controller/add_plan'); ?>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Name','name'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'planname',
                      'id' => 'name',
                      'placeholder' => 'Plan Name' 
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
                      'name' => 'details',
                      'id' => 'details',
                      'placeholder' => 'Plan Details' 
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
                      'name' => 'days',
                      'id' => 'days',
                      'placeholder' => 'Validity Days eg (30, 60, 90)' 
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
                      'name' => 'rate',
                      'type' => 'number',
                      'id' => 'rate',
                      'placeholder' => 'Enter Rate' 
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
                      'name' => 'add_plan',
                      'value' => 'Add Plan'
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
<?php else:  ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>