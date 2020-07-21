<?php if($this->session->userdata('is_logged_in')): ?>
<div class="card">
  <div class="card-header">Edit Profile</div>
  <div class="card-body">
    <div class="bg-danger text-white "> 
      <?php echo validation_errors(); ?>
    </div>
    <?php 
      foreach ($user_detail as $user) {
          $user_data = array(
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->user_email
          );
           }
     ?>
     <!-- Form start -->
    <?php echo form_open('edit_profile_controller/update_profile'); ?>
     <div class="form-group">
       <div class="form-row">
         <div class="col-md-6">
           <div class="form-label-group">
            <?php 
                $data = array(
                  'class' => 'form-control',
                  'name' => 'firstname',
                  'id' => 'firstName',
                  'value' =>  html_escape($user_data['first_name']),
                  'placeholder' => '',
                  'autofocus' => 'autofocus' 
                );
                echo form_input($data);
                echo form_label('First Name','firstName');
             ?>
             </div>
          </div>
          <div class="col-md-6">
            <div class="form-label-group">
             <?php 
                 $data = array(
                   'class' => 'form-control',
                   'name' => 'lastname',
                   'id' => 'lastName',
                   'value' => html_escape($user_data['last_name']),
                   'placeholder' => ''
                 );
                 echo form_input($data);
                 echo form_label('Last Name','lastName');
              ?>
              </div>
           </div>
        </div>
     </div>
     <div class="form-group">
        <div class="form-label-group">
          <?php 
           $data = array(
            'class' => 'form-control',
            'id' => 'inputEmail',
            'value' =>  html_escape($user_data['email']),
            'placeholder' => '',
            'name' => 'useremail'
           );
           echo form_input($data);
           echo form_label('Email address','inputEmail');
           ?>
        </div>
      </div>
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-6">
            <div class="form-label-group">
             <?php 
                 $data = array(
                   'class' => 'form-control',
                   'name' => 'password',
                   'requried' => 'requried',
                   'id' => 'inputPassword',
                   'placeholder' => '' 
                 );
                 echo form_password($data);
                 echo form_label('Password','inputPassword');
              ?>
              </div>
           </div>
           <div class="col-md-6">
             <div class="form-label-group">
              <?php 
                  $data = array(
                  'class' => 'form-control',
                  'name' => 'confirmpassword',
                  'id' => 'confirmPassword',
                  'placeholder' => ''
                );
                echo form_password($data);
                echo form_label('Confirm Password','confirmPassword');
               ?>
               </div>
            </div>
         </div>
      </div>

      <div class="form-group">
        <?php 
          $data = array(
            'class' => 'btn btn-primary ',
            'name' => 'update_profile',
            'value' => 'Update'
          );
          echo form_submit($data);
         ?>
      </div>
      
    <?php echo form_close(); ?>
  </div>
</div>
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>