<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Print_invoice_controller extends CI_Controller {
    
    //View Invoice
	public function index()
	{
		$this->load->view('invoice/print_invoice_view');
	}
	
	//Print Invoice
	public function print($invoice)
	{
		$data['currecny'] = $this->layout_model->get_currency();
	    $data['gym_settings'] = $this->layout_model->get_gym_settings();
		$data['invoice_data'] = $this->members_model->get_member_his_by_invoice($invoice);
		$this->load->view('invoice/print_invoice_view',$data);
	}
	//Redirect to  member_list_controller
	public function redirect()
	{
		redirect( 'member_list_controller');
	}
}
