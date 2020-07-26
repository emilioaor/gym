<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"><i class="fas fa-table"></i> Overview</div>
      <div class="card-body">
        <!-- from start -->
        <?php echo form_open('income_per_month_controller'); ?>

           <div class="form-group row">
             <div class="col-md-2 col-form-label">
                <?php  echo form_label('From','from'); ?>
             </div>
             <div class="col-md-4 col-md-offset-4">
               <?php 
                   $data = array(
                     'class' => 'form-control',
                     'name' => 'i_from',
                     'id' => 'from',
                     'type' => 'date',
                     'placeholder' => ''
                   );
                    $this->load->view('layouts/datepicker', ['attr' => $data])
                ?>
             </div>
           </div>

           <div class="form-group row">
             <div class="col-md-2 col-form-label">
                <?php  echo form_label('To','to'); ?>
             </div>
             <div class="col-md-4 col-md-offset-4">
               <?php 
                   $data = array(
                     'class' => 'form-control',
                     'name' => 'i_to',
                     'id' => 'to',
                     'type' => 'date',
                     'placeholder' => ''
                   );
                    $this->load->view('layouts/datepicker', ['attr' => $data])
                ?>
             </div>
           </div>

           <div class="form-group row"> 
             <div class="col-md-4 col-md-offset-4">
               <?php 
                   $data = array(
                     'class' => 'btn btn-primary',
                     'name' => 'submit',
                     'type' => 'submit',
                     'value' => 'Submit'
                   );
                   echo form_input($data);    
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