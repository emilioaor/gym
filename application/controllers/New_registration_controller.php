<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class New_registration_controller extends CI_Controller {

    //Display Registration View
    public function index()
    {
        $data['plans']	= $this->add_plan_model->get_plan();
        $data['currecny'] = $this->layout_model->get_currency();
        $data['main_view'] = "new_registration_view";
        $this->load->view('layouts/main', $data);
    }

    //Add New Member
    public function add_member()
    {
        $user = $this->register_user_model->get_user_by_email($this->input->post('email'));

        if ($user) {
            $this->session->set_flashdata('alert_type', 'danger');
            $this->session->set_flashdata('alert_msg', 'Email in use');

            redirect('new_registration_controller');
        }

        $config['upload_path']          = './images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 600;
        $config['max_height']           = 600;

        $this->load->library('upload', $config);

        if ( $this->input->post('userimage'))
        {
            if (! $this->upload->do_upload('userimage') )
            {
                $data = array('error' => $this->upload->display_errors());
                $data['currecny'] = $this->layout_model->get_currency();
                $data['plans']	= $this->add_plan_model->get_plan();
                $data['main_view'] = "new_registration_view";
                $this->load->view('layouts/main', $data);
            }
        }
        else
        {
            $data = $this->upload->data();
            $image_path = $data['raw_name'].$data['file_ext'];

            $this->new_registration_model->set('img_path',$image_path);

            $this->form_validation->set_rules('name','Name','trim|required|min_length[3]');
            $this->form_validation->set_rules('plan','Membership Plan','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required|min_length[3]');
            $this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
            $this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|min_length[3]|matches[password]');

            if($this->form_validation->run() == FALSE)
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $data['plans']	= $this->add_plan_model->get_plan();
                $data['error'] = ' ';
                $data['main_view'] = "new_registration_view";
                $this->load->view('layouts/main', $data);

            }
            else
            {
                if($this->new_registration_model->add_member())
                {
                    $this->session->set_flashdata('mem_registered', 'Member has been registered');
                    redirect('new_registration_controller');
                    // $this->do_upload();
                }
                else
                {
                    return false;
                }
            }
        }
    }

    //Display Member Details
    public function member_detail($member_id)
    {
        $data['member_details'] = $this->new_registration_model->get_member_by_id($member_id);

        $data['main_view'] = "edit_member_details_view";
        $this->load->view('layouts/main', $data);
    }

    //Update Member
    public function update_member($member_reg_id)
    {
        $member = $this->new_registration_model->is_email_in_use($this->input->post('email'), $member_reg_id);

        if ($member) {
            $this->session->set_flashdata('alert_type', 'danger');
            $this->session->set_flashdata('alert_msg', 'Email in use');

            redirect('new_registration_controller/member_detail/' . $member_reg_id);
        }

        $config['upload_path']          = './images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 600;
        $config['max_height']           = 600;

        $this->load->library('upload', $config);

        if ( $this->input->post('userimage')){
            if ( ! $this->upload->do_upload('userimage'))
            {
                $data = array('error' => $this->upload->display_errors());
                $data['member_details'] = $this->new_registration_model->get_member_by_id($member_reg_id);

                $data['main_view'] = "edit_member_details_view";
                $this->load->view('layouts/main', $data);
            }
        }else{

            $this->form_validation->set_rules('name','Name','trim|required|min_length[3]');
            $this->form_validation->set_rules('email','Email','trim|required|min_length[3]');

            if ($this->input->post('password') || $this->input->post('confirmpassword')) {
                $this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
                $this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|min_length[3]|matches[password]');
            }

            if(! $this->form_validation->run()) {

                $this->session->set_flashdata('alert_type', 'danger');
                $this->session->set_flashdata('alert_msg', validation_errors());

                redirect('new_registration_controller/member_detail/' .$member_reg_id);
            }


            $data =$this->upload->data();
            $image_path = $data['raw_name'].$data['file_ext'];

            $this->new_registration_model->set('img_path',$image_path);

            $this->new_registration_model->update_member($member_reg_id);

            redirect('member_list_controller');
        }

        if ( ! $this->upload->do_upload('userimage'))
        {
            $data = array('error' => $this->upload->display_errors());
            $data['member_details'] = $this->new_registration_model->get_member_by_id($member_reg_id);

            $data['main_view'] = "edit_member_details_view";
            $this->load->view('layouts/main', $data);
        }
        else
        {
            $this->form_validation->set_rules('name','Name','trim|required|min_length[3]');
            $this->form_validation->set_rules('email','Email','trim|required|min_length[3]');

            if ($this->input->post('password') || $this->input->post('confirmpassword')) {
                $this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
                $this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|min_length[3]|matches[password]');
            }

            if(! $this->form_validation->run()) {

                $this->session->set_flashdata('alert_type', 'danger');
                $this->session->set_flashdata('alert_msg', validation_errors());

                redirect('new_registration_controller/member_detail/' .$member_reg_id);
            }

            $data =$this->upload->data();
            $image_path = $data['raw_name'].$data['file_ext'];

            $this->new_registration_model->set('img_path',$image_path);

            $this->new_registration_model->update_member($member_reg_id);

            redirect('member_list_controller');
        }

    }
}
