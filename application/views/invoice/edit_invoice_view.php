<div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"> <i class="fas fa-table"></i> Edit Invoice</div>
      <div class="card-body">
        <?php 
            //To Put Values in Filed
            foreach ($invoice_details as $invoice) {
              $invoice_detail = array(
                 'member_id' => $invoice->member_reg_id,
                 'member_name' => $invoice->member_name,
                 'invoice' => $invoice->member_his_id,
                 'p_date' => $invoice->member_his_pay_date,
                 'plan_id' => $invoice->member_plan_id,
                 'tammount' => $invoice->plan_total_amount,
                 'pammount' => $invoice->member_paid_amount
              );
            }
        ?>
        <!-- Form Open -->
        <?php echo form_open_multipart('edit_invoice_controller/update_invoice/'. $this->uri->segment(3) .''); ?>
        <div class="form-group row">
          <div class="col-md-2 col-form-label"> 
             <?php  echo form_label('Membership id','membership'); ?>
          </div>
           <div class="col-md-4 col-md-offset-4">
            <?php 
                $data = array(
                  'class' => 'form-control',
                  'name' => 'membership_id',
                  'id' => 'membership',
                  'value' => html_escape($invoice_detail['member_id']),
                  'readonly'=> 'readonly',
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
                  'name' => 'invoice',
                  'id' => 'invoice',
                  'value' => html_escape($invoice_detail['invoice']),
                  'readonly'=> 'readonly',
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
                  'name' => 'name',
                  'id' => 'name',
                  'value' => html_escape($invoice_detail['member_name']),
                  'placeholder' => '' 
                );
                echo form_input($data);    
             ?>
           </div>
        </div>

        <div class="form-group row">
          <div class="col-md-2 col-form-label"> 
             <?php  echo form_label('Payment Date','p_date'); ?>
          </div>
          <div class="col-md-4 col-md-offset-4">
            <?php 
                $data = array(
                  'class' => 'form-control',
                  'name' => 'p_date',
                  'id' => 'p_date',
                  'type' => 'date',
                  'value' => html_escape($invoice_detail['p_date']),
                  'placeholder' => '' 
                );
                echo form_input($data);    
             ?>
           </div>
        </div>

        <div class="form-group row">
          <div class="col-md-2 col-form-label"> 
            <label for="plan">Membership Plan</label>
          </div>
          <div class="col-md-4 col-md-offset-4">  
            <select id="plan"  name="plan" class="form-control">  
                <?php   
                  foreach ($plans as $plan): ?> 
                     <option  value="<?php echo  $plan->plan_id; ?>" <?php if($invoice_detail['plan_id'] == $plan->plan_id){?> selected="selected"  <?php } ?> > <?php echo  html_escape($plan->plan_name); ?> ($<?php echo html_escape($plan->plan_rate); ?>) 
                     </option>
                 <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-2 col-form-label"> 
             <?php  echo form_label('Paid Ammount','pammount'); ?>
          </div>
           <div class="col-md-4 col-md-offset-4">
            <?php 
                $data = array(
                  'class' => 'form-control',
                  'name' => 'pammount',
                  'type' => 'number',
                  'value' => html_escape($invoice_detail['pammount']),
                  'id' => 'pammount',
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
                  'name' => 'update_invoice',
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