<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"><i class="fas fa-table"></i> Pay Balance</div>
      <div class="card-body">
        <?php 
          foreach ($members as $member) {
            $member_data = array(
              'plan_name' => $member->plan_name,
              'plan_id' => $member->plan_id,
              'plan_amount' => $member->plan_total_amount,
              'member_paid' =>  $member->member_paid_amount,
              'invoice' => $member->member_his_id
            );
          }
         ?>
         <?php echo form_open('pay_bal_controller/update_bal/'.html_escape($this->uri->segment(3).'')); ?>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Membership Name','plan_name'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'plan_name',
                      'id' => 'plan_name',
                      'disabled' => TRUE,
                      'value' => html_escape($member_data['plan_name']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Invoice','invoice'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'invoice_id',
                      'id' => 'invoice',
                      'disabled' => TRUE,
                      'value' => html_escape($member_data['invoice']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Total','total'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'total',
                      'id' => 'total',
                      'readonly' => TRUE,
                      'value' => html_escape($member_data['plan_amount']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Paid','paid'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'type' => 'number',
                      'name' => 'paid',
                      'id' => 'paid',
                      'value' => html_escape($member_data['member_paid']),
                      'placeholder' => '' 
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
                      'name' => 'update_bal',
                      'value' => 'Submit'
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