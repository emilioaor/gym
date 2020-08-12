<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"> <i class="fas fa-table"></i> Edit Member Details</div>
      <div class="card-body">
        <?php if(isset($error))
        {
          echo "<div class='bg-danger text-white'>".html_escape($error)."</div>";
        } 
        ?>
        <?php 
            foreach ($member_details as $member) 
            {
              $member_detail = array(
                 'member_id' => $member->member_reg_id,
                 'member_name' => $member->member_name,
                 'member_sex' => $member->member_sex,
                 'member_proof' => $member->member_proof,
                 'member_age' => $member->member_age,
                 'member_contact' => $member->member_contact,
                 'member_address' => $member->member_address,
                 'member_email' => $member->member_email,
                 'member_height' => $member->member_height,
                 'member_weight' => $member->member_weight,
                 'member_img' => $member->member_img,
                 'member_birthday_date' => $member->member_birthday_date,
                 'member_notes' => $member->member_notes
              );
            }
            $date = explode('-', $member_detail['member_birthday_date']);
         ?>
        <?php echo form_open_multipart('new_registration_controller/update_member/'. html_escape($this->uri->segment(3)) .''); ?>
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
                      'value' => html_escape($member_detail['member_id']),
                      'readonly'=> 'readonly',
                      'placeholder' => '' 
                    );
                    echo form_input($data);    
                 ?>
               </div>
            </div>
          <div class="form-group row">
              <div class="col-md-2 col-form-label">
                  <?php  echo form_label('Email','email'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                  <input type="hidden" name="email_original" value="<?php echo html_escape($member_detail['member_email']) ?>">
                  <?php
                  $data = array(
                      'class' => 'form-control',
                      'name' => 'email',
                      'id' => 'email',
                      'value' => html_escape($member_detail['member_email']),
                      'placeholder' => ''
                  );
                  echo form_input($data);
                  ?>
              </div>
          </div>
          <div class="form-group row">
              <div class="col-md-2 col-form-label">
                  <?php  echo form_label('Password','password'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                  <?php
                  $data = array(
                      'class' => 'form-control',
                      'name' => 'password',
                      'id' => 'password',
                      'placeholder' => 'Enter Password',
                      'type' => 'password',
                  );
                  echo form_input($data);
                  ?>
              </div>
          </div>

          <div class="form-group row">
              <div class="col-md-2 col-form-label">
                  <?php  echo form_label('Confirm Password','password'); ?>
              </div>
              <div class="col-md-4 col-md-offset-4">
                  <?php
                  $data = array(
                      'class' => 'form-control',
                      'name' => 'confirmpassword',
                      'id' => 'confirmpassword',
                      'placeholder' => 'Confirm Password',
                      'type' => 'password',
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
               <!--  <img  src="<?php //echo base_url(); ?>images/placeholder.png" width="200" alt="Image" class="img-thumbnail"> -->
                <div class="input-group mt-2">
                    <div class="custom-file">
                      <input type="file" name="userimage" value="<?php echo $member_detail['member_img'];?>" class="custom-file-input" id="inputGroupFile01">
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
                      'value' => html_escape($member_detail['member_name']),
                      'placeholder' => '' 
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
                    echo form_dropdown($data,$options,$date[2]);    
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
                    echo form_dropdown($data,$options,$date[1]);    
                 ?>
               </div>
               <div class="col-md-2">
                <?php 
                    $options= array(
                      '1960' => '1960', '1961' => '1961', '1962' => '1962', '1963' => '1963', '1964' => '1964',
                      '1965' => '1965', '1966' => '1966', '1967' => '1967', '1968' => '1968', '1969' => '1969',
                      '1970' => '1970', '1971' => '1971', '1972' => '1972', '1973' => '1973', '1974' => '1974',
                      '1975' => '1975', '1976' => '1976', '1977' => '1977', '1978' => '1978', '1979' => '1979',
                      '1980' => '1980', '1981' => '1981', '1982' => '1982', '1983' => '1983', '1984' => '1984',
                      '1985' => '1985', '1986' => '1986', '1987' => '1987', '1988' => '1988', '1989' => '1989',
                      '1990' => '1990', '1991' => '1991', '1992' => '1992', '1993' => '1993', '1994' => '1994',
                      '1995' => '1995', '1996' => '1996', '1997' => '1997', '1998' => '1998', '1999' => '1999',
                      '2000' => '2000', '2001' => '2001', '2002' => '2002', '2003' => '2003', '2004' => '2004',
                      '2005' => '2005', '2006' => '2006', '2007' => '2007', '2008' => '2008', '2009' => '2009',
                      '2010' => '2010'
                    );
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'year',
                      'id' => 'year' 
                    );
                    echo form_dropdown($data,$options,$date[0]);    
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
                      'value' => html_escape($member_detail['member_proof']),
                      'placeholder' => ''  
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
                      'value' => html_escape($member_detail['member_age']),
                      'placeholder' => '' 
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
                      'female'         => 'Female',
                      'male'           => 'Male'
                    );
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'sex',
                      'id' => 'sex' 
                    );
                    echo form_dropdown($data,$options,$member_detail['member_sex']);    
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
                      'value' => html_escape($member_detail['member_address']),
                      'placeholder' => ''  
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
                      'value' => html_escape($member_detail['member_contact']),
                      'placeholder' => '' 
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
                      'value' => html_escape($member_detail['member_height']),
                      'placeholder' => ''  
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
                      'value' => html_escape($member_detail['member_weight']),
                      'placeholder' => '' 
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
                      'placeholder' => 'Enter Notes',
                      'value' => html_escape($member_detail['member_notes']),
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
                      'name' => 'update_member',
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