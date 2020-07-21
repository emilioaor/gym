<?php if($this->session->userdata('is_logged_in')): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-3 ">
      <div class="card-header"><i class="fas fa-table"></i> Change Logo</div>
      <div class="card-body">
         <div class="bg-danger text-white">
            <?php if(isset($error)){ echo $error; }?>
         </div>
         <?php echo form_open_multipart('layout_controller/update_logo'); ?>
         <div class="form-group row">
           <div class="col-md-2 col-form-label"> 
              <?php  echo form_label('Upload Logo','brandlogo'); ?>
           </div>
            <div class="col-md-4 col-md-offset-4">
            <!--  <img  src="<?php //echo base_url(); ?>images/placeholder.png" width="200" alt="Image" class="img-thumbnail"> -->
             <div class="input-group mt-2">
                 <div class="custom-file">  
                   <input type="file" name="brandlogo" class="custom-file-input" id="logo">
                   <label class="custom-file-label" for="logo">max size 1MB (460x275)</label>
                 </div>
             </div>
           </div>
         </div>

         <div class="form-group row">
           <div class="col-sm-10"> 
              <?php 
                 $data = array(
                   'class' => 'btn btn-primary',
                   'name' => 'update_logo',
                   'value' => 'Save'
                 );
                 echo form_submit($data);    
              ?>
           </div>
         </div>
         <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card mb-3 ">
      <div class="card-header"><i class="fas fa-table"></i> Change Brand Name</div>
      <div class="card-body">
        <?php 
            foreach ($gym_settings as $settings) 
            {
              $setting = array(
                'brand_name' => $settings->brand_name,
                'brand_dis' => $settings->brand_description,
                'country' => $settings->country_name,
                'city' => $settings->city_name,
                'phone_num' => $settings->phone_num,
                'rule1' => $settings->rule_1,
                'rule2' => $settings->rule_2,
                'rule3' => $settings->rule_3,
                'rule4' => $settings->rule_4,
                'rule5' => $settings->rule_5,
                'rule6' => $settings->rule_6,
                'logo' => $settings->logo_img
              );
            }
         ?>
         <?php echo form_open('layout_controller/update_brand'); ?>

            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Brand Name','brandname'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'brandname',
                      'id' => 'brandname',
                      'value' => html_escape($setting['brand_name']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Brand Description','branddescription'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'branddescription',
                      'id' => 'branddescription',
                      'value' => html_escape($setting['brand_dis']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Country','country'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'country',
                      'id' => 'country',
                      'value' => html_escape($setting['country']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('City','city'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'city',
                      'id' => 'city',
                      'value' => html_escape($setting['city']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Phone','phone'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'type' => 'number',
                      'name' => 'phone',
                      'id' => 'phone',
                      'value' => html_escape($setting['phone_num']),
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Currency','currency'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $options = array(
                      html_escape('$')    => html_escape('$ (DOLLAR)'),
                      html_escape('PKR')  => html_escape('PKR (PAK RUPPIES)'),
                      html_escape('INR')  => html_escape('INR (IND RUPPIES)')
                    );
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'currency',
                      'id' => 'currency' 
                    );
                    echo form_dropdown($data,$options,'Male');    
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-10"> 
                 <?php 
                    $data = array(
                      'class' => 'btn btn-primary',
                      'name' => 'update_brand',
                      'value' => 'Save Settings'
                    );
                    echo form_submit($data);    
                 ?>
              </div>
            </div>
         <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"><i class="fas fa-table"></i> Change Gym Rules</div>
      <div class="card-body">
         <?php echo form_open('layout_controller/update_rules'); ?>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Rule # 1','rule1'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'rule1',
                      'id' => 'rule1',
                      'rows' => '3',
                      'value' => html_escape($setting['rule1']),
                      'placeholder' => '' 
                    );
                    echo form_textarea($data);  
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Rule # 2','rule2'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'rule2',
                      'id' => 'rule2',
                      'rows' => '3',
                      'value' => html_escape($setting['rule2']),
                      'placeholder' => '' 
                    );
                    echo form_textarea($data);      
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Rule # 3','rule3'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'rule3',
                      'id' => 'rule3',
                      'rows' => '3',
                      'value' => html_escape($setting['rule3']),
                      'placeholder' => '' 
                    );
                     echo form_textarea($data);  
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Rule # 4','rule4'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'rule4',
                      'id' => 'rule4',
                      'rows' => '3',
                      'value' => html_escape($setting['rule4']),
                      'placeholder' => '' 
                    );
                    echo form_textarea($data);      
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Rule # 5','rule5'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'rule5',
                      'id' => 'rule5',
                      'rows' => '3',
                      'value' => html_escape($setting['rule5']),
                      'placeholder' => '' 
                    );
                    echo form_textarea($data);    
                 ?>
              </div>
            </div>
             <div class="form-group row">
              <div class="col-md-2 col-form-label">
                 <?php  echo form_label('Rule # 6','rule6'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'rule6',
                      'id' => 'rule6',
                      'rows' => '3',
                      'value' => html_escape($setting['rule6']),
                      'placeholder' => '' 
                    );
                    echo form_textarea($data);    
                 ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10"> 
                 <?php 
                    $data = array(
                      'class' => 'btn btn-primary',
                      'name' => 'update_rules',
                      'value' => 'Save Rules'
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