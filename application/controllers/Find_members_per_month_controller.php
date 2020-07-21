<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Find_members_per_month_controller extends CI_Controller {
    
    //Display Date Range Fields
	public function index()
	{
		$data['main_view'] = "find_members_per_month_view";
		$this->load->view('layouts/main', $data);
	}
}
