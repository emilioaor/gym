<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Plan_controller extends CI_Controller {
	 
	//View Plans
	public function index()
	{
		$data['currecny'] = $this->layout_model->get_currency();
		$data['plans'] = $this->add_plan_model->get_plan();
		$data['main_view'] = "plan_view";
		$this->load->view('layouts/main', $data);
	}
}
