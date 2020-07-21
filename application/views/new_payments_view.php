<?php if($this->session->userdata('is_logged_in')): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"><i class="fas fa-table"></i> New Payments</div>
      <div class="card-body">
          <?php 
            foreach ($member_details as  $member) 
            {
              $member_data  = array(
                'member_name' => $member->member_name,
                'member_id' => $member->member_reg_id,
                'image' => $member->member_img
              );
            }
           ?>
            <?php echo form_open('new_payments_controller/add_payment'); ?>
               <div class="form-group row">
                 <div class="col-md-2 col-form-label">
                    <?php  echo form_label('Membership Id','member_id'); ?>
                 </div>
                 <div class="col-md-4 col-md-offset-4">
                   <?php 
                       $data = array(
                         'class' => 'form-control',
                         'name' => 'member_id',
                         'id' => 'member_id',
                         'type' => 'number',
                         'readonly' => TRUE,
                         'value' => html_escape($member_data['member_id']),
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
                         'readonly' => TRUE,
                         'id' => 'name',
                         'value' => html_escape($member_data['member_name']),
                         'placeholder' => '' 
                       );
                       echo form_input($data);    
                    ?>
                 </div>
               </div>
               <div class="form-group row">
                 <div class="col-md-2 col-form-label">
                    <?php  echo form_label('Image','image'); ?>
                 </div>
                 <?php if($member_data['image']): ?>
                 <div class="col-md-4 col-md-offset-4">
                    <img src="<?php echo base_url(); ?>images/<?php echo $member_data['image']; ?>" id="image" width="200" alt="Image" class="img-thumbnail">
                </div>
                <?php else: ?>
                   <div class="col-md-4 col-md-offset-4">
                      <p> No Preview</p>
                   </div>
                <?php endif; ?>
               </div>
               <div class="form-group row">
                 <div class="col-md-2 col-form-label">
                    <?php  echo form_label('Payment Date','date'); ?>
                 </div>
                 <div class="col-md-4 col-md-offset-4">
                   <?php 
                       $data = array(
                         'class' => 'form-control',
                         'type' => 'date',
                         'readonly' => TRUE,
                         'name' => 'pay_date',
                         'value' =>  date('Y-m-d'),
                         'id' => 'date'
                       );
                       echo form_input($data);    
                    ?>
                 </div>
               </div>
               <div class="form-group row">
                 <div class="col-md-2 col-form-label"> 
                   <label for="plan">Membership Type</label>
                 </div>
                  <div class="col-md-4 col-md-offset-4">  
                       <select id="plan" name="plan" class="form-control">  
                           <option value="">Select</option>
                           <?php   
                             foreach ($plans as $plan) {
                               echo '<option value="'. html_escape($plan->plan_id) .'" >'. html_escape($plan->plan_name)  .' ('.html_escape($currecny).'' .html_escape($plan->plan_rate) . ') </option>';
                             }
                            ?>
                       </select>
                   </div>
               </div>
               <div class="form-group row">
                 <div class="col-md-2 col-form-label">
                    <?php  echo form_label('Paid Amount','pamount'); ?>
                 </div>
                 <div class="col-md-4 col-md-offset-4">
                   <?php 
                       $data = array(
                         'class' => 'form-control',
                         'name' => 'pamount',
                         'type' => 'number',
                         'id' => 'pamount',
                         'placeholder' => '00.0' 
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
                         'name' => 'add_payment',
                         'value' => 'Add Payment'
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
</div>
<?php else:  ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>