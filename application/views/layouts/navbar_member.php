<ul class="navbar-nav">
    <li class="nav-item <?php if($s == "Home"){ echo html_escape('active'); } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>member_controller">Dashboard</a>
    </li>
    <li class="nav-item <?php if($s == "Classes"){ echo html_escape('active'); } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>class_controller">Classes</a>
    </li>
</ul>