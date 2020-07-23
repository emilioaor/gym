<?php if ($this->session->alert_type && $this->session->alert_msg): ?>
    <div>
        <div class="alert alert-<?php echo $this->session->alert_type ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>¡Alert!</strong> <?php echo $this->session->alert_msg ?>
        </div>
    </div>
<?php endif ?>
