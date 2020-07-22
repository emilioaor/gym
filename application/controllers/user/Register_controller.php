<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register_controller extends CI_Controller {

    //To Register New User 
    public function register_user()
    {
        $this->form_validation->set_rules('firstname','Username','trim|required|min_length[3]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[3]');
        $this->form_validation->set_rules('email','Email','trim|required|min_length[3]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
        $this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|min_length[3]|matches[password]');

        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'errors' => validation_errors()
            );

            $this->load->view('user/register_view');

        } else {

            if($this->register_user_model->create_user())
            {
                $this->session->set_flashdata('user_registered', 'User has been registered');
                redirect('Login_controller');
            } else {

            }
        }
    }

    // Login to dashboard
    public function login_user()
    {

        $user_id = $this->register_user_model->login();
        $this->register_user_model->set('user_id',$user_id);
        $data = $this->register_user_model->get_user();
        if(!empty($data))
        {
            foreach ($data as $value) {
                $sess_data = array(
                    'id'           => $value->user_id,
                    'username'     => $value->first_name
                );
                $this->session->set_userdata($sess_data);
            }
        }

        if($user_id)
        {
            $email = html_escape($this->input->post('useremail'));
            $user_data = array(

                'email' => $email,
                'user_id' => $user_id,
                'is_logged_in' => true
            );
            $this->session->set_userdata($user_data);
            redirect('admin_controller');
        }else
        {
            redirect('Login_controller');
        }

    }

    //To Logout
    public function logout_user()
    {
        $this->session->sess_destroy();
        redirect('');
    }
}
