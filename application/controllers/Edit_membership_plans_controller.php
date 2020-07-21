<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit_membership_plans_controller extends CI_Controller {
    //Display Edit Plan Form
	public function index()
	{
		$data['main_view'] = "edit_membership_plans_view";
		$this->load->view('layouts/main', $data);
	}
}
