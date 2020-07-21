<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// No Use FOr Now
class Edit_member_details_controller extends CI_Controller {
    
    // Display Edit Member Form
	public function index()
	{
		$data['main_view'] = "edit_member_details_view";
		$this->load->view('layouts/main', $data);
	}
}
  