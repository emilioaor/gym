<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_controller extends CI_Controller {
    
    //Display Admin View
	public function index()
	{
	    $data['currecny'] = $this->layout_model->get_currency();
		$data['total_mem_in_month'] = $this->admin_model->count_members();
		$data['total_members'] = $this->admin_model->total_members();
		$total_plans = $this->admin_model->total_plans();
		$expire_mem = $this->admin_model->get_expire_members(); 
		$unpaid_members = $this->admin_model->get_unpaid_members();
		$data['income_per_month'] = $this->admin_model->payments_per_month();
		$data['birthdayDates'] = $this->admin_model->getBirthdayDates();
		$data['birthday'] = $this->admin_model->getBirthday();
	 
		$chart = array(	$data['total_members'] , $data['total_mem_in_month'],$unpaid_members,$expire_mem,$total_plans);
		$data['chart_data'] = json_encode($chart);

		$data['data'] = [
		    'calendar' => $this->admin_model->getBirthdayCalendar(),
            'next5days' => $this->admin_model->next5daysBirthdays()
        ];

		$data['main_view'] = "admin_view";
		$this->load->view('layouts/main', $data);
	}
}
