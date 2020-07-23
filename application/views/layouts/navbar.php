<?php
$gym_settings = $this->layout_model->get_gym_settings();
foreach ($gym_settings as $name)
{
    $brand_name = html_escape($name->brand_name);
}
?>

<?php
    $role_controller = $this->session->userdata('role') === 'admin' ? 'admin_controller' : 'member_controller';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo base_url() . $role_controller; ?>"><?php echo html_escape($brand_name); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">

        <?php if ($this->session->userdata('role') === 'admin') { $this->load->view('layouts/navbar_admin', compact('s')); } ?>
        <?php if ($this->session->userdata('role') === 'member') { $this->load->view('layouts/navbar_member', compact('s')); } ?>

        <ul class="navbar-nav  ml-auto  ">
            <li class="nav-item dropdown no-arrow <?php if($s == 'Edit Profile'){ echo 'active'; } ?>">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><?php echo $this->session->userdata('username'); ?></span>  <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>edit_profile_controller">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>

        </ul>
    </div>
</nav>