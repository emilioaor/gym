<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card  mb-3 ">
      <div class="card-header"> <i class="fas fa-table"></i> Edit Membership</div>
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
                 'member_exp_date' => $member->member_exp_date,
                 'member_join_date' => $member->member_join_date,
              );
            }
         ?>
        <?php echo form_open('new_registration_controller/updateMembership/'.$member_detail['member_id']); ?>
            <div class="form-group row">
              <div class="col-md-6 col-form-label"> 
                <p>Membership id <b><?php  echo html_escape($member_detail['member_id']); ?></b>
                 Name: <b><?php  echo html_escape($member_detail['member_name']); ?></b></p>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Membership  Join','membershipJoinDate'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'membershipJoinDate',
                      'id' => 'membershipJoinDate',
                      'type' => 'date',
                      'value' => html_escape($member_detail['member_join_date'])
                    );
                    $this->load->view('layouts/datepicker', ['attr' => $data])
                 ?>
               </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2 col-form-label"> 
                 <?php  echo form_label('Membership Expiry','membershipExpiry'); ?>
              </div>
               <div class="col-md-4 col-md-offset-4">
                <?php 
                    $data = array(
                      'class' => 'form-control',
                      'name' => 'membershipExpiry',
                      'id' => 'membershipExpiry',
                      'type' => 'date',
                      'value' => html_escape($member_detail['member_exp_date'])
                    );
                    $this->load->view('layouts/datepicker', ['attr' => $data])
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