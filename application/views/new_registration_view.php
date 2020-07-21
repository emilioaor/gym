<?php if($this->session->userdata('is_logged_in')): ?>
 <div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"><i class="fas fa-table"></i> New Registration</div>
      <div class="card-body">
        <div class="bg-danger text-white">  
          <?php if(isset($error)){ echo $error; }?>
          <?php echo  validation_errors(); ?>
        </div>
         <?php echo form_open_multipart('new_registration_controller/add_member'); ?>
          <div class="form-group row">
            <div class="col-md-2 col-form-label"> 
               <?php  echo form_label('Membership id','membership'); ?>
            </div>
             <div class="col-md-4 col-md-offset-4">
              <?php 
                  $member_id = random_string('numeric',6);
                  $data = array(
                    'class' => 'form-control',
                    'name' => 'membership_id',
                    'id' => 'membership',
                    'value' =>   $member_id,
                    'readonly'=> 'readonly',
                    'placeholder' => '' 
                  );
                  echo form_input($data);    
               ?>
             </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Upload Image','userimage'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <div class="input-group mt-2">
                    <div class="custom-file">
                      <input type="file" name="userimage" class="custom-file-input" id="inputGroupFile01">
                      <label class="custom-file-label" for="inputGroupFile01">max size 2MB (600x600)</label>
                    </div>
                </div>
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
                      'placeholder' => 'Enter Name' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Birthday Date','birthdayDate'); ?>
              </div>
               <div class="col-md-1">
                <?php 
                      $options= array(
                        '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', 
                        '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12',
                        '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18',
                        '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24',
                        '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30',
                        '31' => '31', 
                      );
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'day',
                      'id' => 'day' 
                    );
                    echo form_dropdown($data,$options,'day');    
                 ?>
               </div>
               <div class="col-md-1">
                <?php 
                    $options= array(
                      '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', 
                      '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12' 
                    );
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'month',
                      'id' => 'month' 
                    );
                    echo form_dropdown($data,$options,'month');    
                 ?>
               </div>
               <div class="col-md-2">
                <?php 
                    $options = [];
                    //array_push($options, 'Year');
                    for($index = 1950; $index <2011; $index++){
                      array_push($options, $index);
                    }
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'year',
                      'id' => 'year' 
                    );
                    echo form_dropdown($data,$options,'year');    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Email','email'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'email',
                      'id' => 'email',
                      'placeholder' => 'Enter Email' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Proof Given','proofgiven'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'proofgiven',
                      'id' => 'proofgiven',
                      'placeholder' => 'Enter Proof' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>
             
            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Age','age'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'age',
                      'id' => 'age',
                      'placeholder' => 'Enter Age' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Sex','sex'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $options = array(
                      'Female'         => 'Female',
                      'Male'           => 'Male'
                    );
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'sex',
                      'id' => 'sex' 
                    );
                    echo form_dropdown($data,$options,'Male');    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Address','address'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'address',
                      'id' => 'address',
                      'placeholder' => 'Enter Address' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Contact','contact'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'type' => 'number',
                      'name' => 'contact',
                      'id' => 'contact',
                      'placeholder' => 'Enter Contact Number' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Height','height'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'type' => 'number',
                      'name' => 'height',
                      'id' => 'height',
                      'step' => '0.01',
                      'placeholder' => 'Enter Height in inches' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Weight','weight'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'type' => 'number',
                      'name' => 'weight',
                      'id' => 'weight',
                      'step' => '0.01',
                      'placeholder' => 'Enter Weight in kg' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Notes','notes'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'notes',
                      'id' => 'notes',
                      'placeholder' => 'Enter Notes' 
                    );
                    echo form_textarea($data);    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                <label for="plan">Membership Plan</label>
              </div>
               <div class="col-md-4 col-md-offset-4">  
                    <select id="plan" name="plan" class="form-control">  
                        <option value="">Select</option>
                        <?php   
                          foreach ($plans as $plan) {
                            echo '<option value="'. html_escape($plan->plan_id) .'" >'. html_escape($plan->plan_name)  .' ('. html_escape($currecny) .''. html_escape($plan->plan_rate) . ') </option>';
                          }
                         ?>
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
                      'id' => 'pammount',
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
                      'name' => 'add_member',
                      'value' => 'Register'
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