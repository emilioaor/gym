<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pay_bal_controller extends CI_Controller {
    
    //View Form
	public function index()
	{
		$data['main_view'] = "pay_bal_view";
		$this->load->view('layouts/main', $data);
	}
    
    //Pay due Balance
	public function add_bal($invoice_id)
	{
		$data['members'] = $this->payment_model->get_member_and_plan($invoice_id);
		$data['main_view'] = "pay_bal_view";
		$this->load->view('layouts/main', $data);
	}
	
	//Update due Balance
	public function update_bal($invoice_id)
	{
		if($this->payment_model->pay_balance($invoice_id))
		{
			redirect('unpaid_members_alert_controller'); 
		}
	}
}
