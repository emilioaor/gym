<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_histroy_controller extends CI_Controller {
    //Load Hstroy Page
	public function index()
	{
		$data['main_view'] = "member_histroy_view";
		$this->load->view('layouts/main', $data);
	}
	
	//Diplay Histroy
	public function view_histroy($member_id)
	{
		$data['currecny'] = $this->layout_model->get_currency();
		$data['member_details'] = $this->members_model->get_member($member_id); 
		$data['member_his_details'] = $this->members_model->get_member_his($member_id); 
		$data['main_view'] = "member_histroy_view";
		$this->load->view('layouts/main', $data);
	}

	//Delete the member histroy invoice
	public function delete_his($mem_invoice)
	{
		if($this->members_model->delete_his_invoice($mem_invoice))
		{
			redirect('member_list_controller');
		}
	}
}
