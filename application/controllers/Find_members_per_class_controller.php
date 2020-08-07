<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Find_members_per_class_controller extends CI_Controller {
    
    //Display Income per Month
	public function index()
	{
		$data['main_view'] = "find_members_per_class_view";
		$this->load->view('layouts/main', $data);
	}

	public function get_by_date()
    {
        $from = $this->input->post('i_from');
        $to = $this->input->post('i_to');
        $data['data']['classes'] = $this->class_model->subscribers_by_date_range($from, $to);

        $data['main_view'] = "members_per_class_view";
        $this->load->view('layouts/main', $data);
    }

}
