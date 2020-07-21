<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ending_members_controller extends CI_Controller {
    
    //Display Ending Members
	public function index()
	{	
		$data['expired_mem'] = $this->members_model->get_all_end_members();
		$data['currecny'] = $this->layout_model->get_currency();
		$data['main_view'] = "ending_members_view";
		$this->load->view('layouts/main', $data);
	}
}
