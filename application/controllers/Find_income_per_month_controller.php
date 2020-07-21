<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Find_income_per_month_controller extends CI_Controller {
    
    //Display Income per Month
	public function index()
	{
		$data['main_view'] = "find_income_per_month_view";
		$this->load->view('layouts/main', $data);
	}
}
