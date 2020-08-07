<ul class="navbar-nav">
    <li class="nav-item <?php if($s == "Home"){ echo html_escape('active'); } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin_controller">Dashboard</a>
    </li>

    <li class="nav-item <?php if($s == "Registration"){ echo html_escape('active'); } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>new_registration_controller">New Registration</a>
    </li>

    <li class="nav-item <?php if($s == "Payment"){ echo html_escape('active'); } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>payments_controller">Payments</a>
    </li>

    <li class="nav-item <?php if($s == "Member List"){ echo html_escape('active'); } ?>" >
        <a class="nav-link" href="<?php echo base_url(); ?>member_list_controller">Members</a>
    </li>

    <li class="nav-item dropdown <?php if($s == "Classes"){ echo html_escape('active'); } ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Classes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo base_url(); ?>admin_class_controller">Subscribers</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>admin_class_controller/setting">Setting</a>
        </div>
    </li>

    <li class="nav-item dropdown <?php if($s == 'Edit Plans' || $s == 'Add Plan' ){ echo html_escape('active'); } ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Plan
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo base_url(); ?>add_plan_controller/add_plan">New Plan</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>plan_controller">Edit Plan</a>
        </div>
    </li>

    <li class="nav-item dropdown <?php if($s == 'Find Income' || $s == 'Find Members' || $s == 'Find Members Class' ){ echo html_escape('active'); } ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Overview
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo base_url(); ?>find_members_per_month_controller">Members per month</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>find_income_per_month_controller">Income per month</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>find_members_per_class_controller">Members per class</a>
        </div>
    </li>

    <li class="nav-item dropdown <?php if($s == 'Unpaid Members' || $s == 'Ending Members' ){ echo html_escape('active'); } ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Alert
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo base_url(); ?>unpaid_members_alert_controller">Unpaid members</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>ending_members_controller">Ending members</a>
        </div>
    </li>

    <li class="nav-item <?php if($s == "Settings"){ echo html_escape('active'); } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>layout_controller">Settings</a>
    </li>

</ul>