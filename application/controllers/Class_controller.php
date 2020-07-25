<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Class_controller extends CI_Controller {
    

	public function index()
    {
        $data['main_view'] = "member_classes_view";
        $data['data'] = $this->class_model->class_today();

        $this->load->view('layouts/main', $data);
    }

    public function subscribe()
    {
        $this->class_model->subscribe_class();
        $this->session->set_flashdata('alert_type', 'success');
        $this->session->set_flashdata('alert_msg', 'Process completed');

        redirect('class_controller');
    }

    public function unsubscribe()
    {
        $this->class_model->unsubscribe_by_date(html_escape($this->input->post('date')));
        $this->session->set_flashdata('alert_type', 'success');
        $this->session->set_flashdata('alert_msg', 'Process completed');

        redirect('class_controller');
    }
}
