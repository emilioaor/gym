<?php if($this->session->userdata('is_logged_in')): ?>
    <div class="row">

        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">

                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-user-tag"></i>
                    </div>
                    <div class="mr-5 font-weight-bold"><?php echo $this->session->userdata('member')->plan_name ?></div>
                    <div class="mr-5">Plan</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">

                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-birthday-cake"></i>
                    </div>
                    <div class="mr-5 font-weight-bold"><?php echo $this->session->userdata('member')->member_birthday_date ?></div>
                    <div class="mr-5">Birthday</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">

                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-money-bill-alt"></i>
                    </div>
                    <div class="mr-5 font-weight-bold"><?php echo $this->session->userdata('member')->member_payment_date ?></div>
                    <div class="mr-5">Payment Date</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">

                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-calendar"></i>
                    </div>
                    <div class="mr-5 font-weight-bold"><?php echo $this->session->userdata('member')->member_exp_date ?></div>
                    <div class="mr-5">Expiration Date</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-info"></i>
            Information</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-tag"></i>
                        Name:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_name ?>
                </div>
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-address-book"></i>
                        Address:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_address ?>
                </div>
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-phone"></i>
                        Contact:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_contact ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-calendar"></i>
                        Age:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_age ?>
                </div>
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-user"></i>
                        Sex:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_sex ?>
                </div>
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-calendar-alt"></i>
                        Date Joined:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_join_date ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-mail-bulk"></i>
                        Email:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_email ?>
                </div>
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-user"></i>
                        Height:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_height ?>
                </div>
                <div class="col-sm-4 form-group">
                    <strong>
                        <i class="fa fa-user"></i>
                        Weight:
                    </strong><br>
                    <?php echo $this->session->userdata('member')->member_weight ?>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <?php redirect('login_controller'); ?>
<?php endif; ?>