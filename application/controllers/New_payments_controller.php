<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class New_payments_controller extends CI_Controller {
 	
 	//GETTER FUNCTION TO GET THE VAIRABLE
 	public function get($name)
 	{
 	    return $this->$name;
 	}

 	//USED TO WRITE THE VALUE OF PROPERTY
 	public function set($name, $value)
 	{
 	    $this->$name = $value;
 	}
 	
 	//Add Payments
 	public function add_payment()
 	{
 		if($this->payment_model->add_payment())
 		{
 			redirect('payments_controller');
 		}
 	}
 	
 	//Show Members
	public function show_member($member_id)
	{		
		 $data['currecny'] = $this->layout_model->get_currency();
		 $data['member_details'] = $this->payment_model->get_member($member_id);
		 $data['plans'] = $this->add_plan_model->get_plan();
		 $data['main_view'] = "new_payments_view";
		 $this->load->view('layouts/main', $data);
	}
}
