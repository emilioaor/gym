<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_plan_controller extends CI_Controller {
	
	//Add Plan
	public function add_plan()
	{
		$this->form_validation->set_rules('planname','Plan Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('rate','Rate','trim|required');
		$this->form_validation->set_rules('days','Days','trim|required');

		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'errors' => validation_errors()
			);
			
			$data['main_view'] = "add_plan_view";
		    $this->load->view('layouts/main', $data);

		} else {	
			
			if($this->add_plan_model->add_plan())
			{
				$this->session->set_flashdata('plan_added', 'Plan Has Been Added');
				redirect('add_plan_controller/add_plan');
			} else {

			}
		}
	}
    
    //Get Plan By Plan ID
	public function get_plan_by_id($plan_id)
	{
		$data['plan_details'] = $this->add_plan_model->get_plan_by_id($plan_id);

		$data['main_view'] = "edit_membership_plans_view";
		$this->load->view('layouts/main', $data);
	}
    
    //Update Plan
	public function update_plan($plan_id)
	{
	 
		if($this->add_plan_model->edit_plan($plan_id))
		{
			 redirect('plan_controller');
		}
	}
    
    //Delete Plan
	public function delete_plan($plan_id){
		if($this->add_plan_model->delete($plan_id))
		{
			redirect('plan_controller');
		}
			
	}
}
