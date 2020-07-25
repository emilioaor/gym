<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_class_controller extends CI_Controller {
    

	public function index()
    {
        $data['main_view'] = "admin_classes_view";
        $data['data'] = $this->class_model->class_today();

        $this->load->view('layouts/main', $data);
    }

    public function setting()
    {
        $data['main_view'] = 'admin_classes_setting_view';
        $data['data']['classes'] = $this->class_model->get_all();

        $this->load->view('layouts/main', $data);
    }

    public function save_setting()
    {
        $this->class_model->save_setting();
        $this->session->set_flashdata('alert_type', 'success');
        $this->session->set_flashdata('alert_msg', 'Process completed');

        redirect('admin_class_controller/setting');
    }
}
