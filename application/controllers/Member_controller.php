<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_controller extends CI_Controller {
    
    //Display Admin View
	public function index()
	{
		$data['main_view'] = "member_view";
		$this->load->view('layouts/main', $data);
	}
}
