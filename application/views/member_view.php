  <?php if($this->session->userdata('is_logged_in')): ?>
  <h1>Miembro</h1>
  
<?php else: ?>
<?php redirect('login_controller'); ?>
<?php endif; ?>