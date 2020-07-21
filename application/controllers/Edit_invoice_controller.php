<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit_invoice_controller extends CI_Controller {
    
    //Display Plans
	public function index()
	{	
		$data['plans']	= $this->add_plan_model->get_plan();
		$data['main_view'] = "invoice/edit_invoice_view";
		$this->load->view('layouts/main', $data);
	}
    
    //To Get History of specific member
	public function get_his($mem_invoice)
	{
		$data['plans']	= $this->add_plan_model->get_plan();
		$data['invoice_details'] = $this->members_model->get_member_his_by_invoice($mem_invoice);

		$data['main_view'] = "invoice/edit_invoice_view";
		$this->load->view('layouts/main', $data);
	}
    
    //To Update Invoice
	public function update_invoice($invoice_id)
	{
		if($this->members_model->update_invoice($invoice_id))
		{
			redirect('member_list_controller');
		}
	}
}
