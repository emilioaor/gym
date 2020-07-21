<?php
class New_registration_model extends CI_Model {
	
    //Variables
	private $img_path;
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
	
	// Add new Members
	public function add_member()
	{
		//to get plan id and rates from plan table
		$plan_id = html_escape($this->input->post('plan'));
		$get_plan_detail = $this->db->where('plan_id', $plan_id);
		$get_plan_detail = $this->db->get('plans');
		$days = $get_plan_detail->row(3)->plan_days;
		$rate =  $get_plan_detail->row(4)->plan_rate;
		
		// to find the expiry date
		$member_payment_date =  date("Y-m-d");
		$member_exp_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($member_payment_date)) ."+". $days."day"));

		// To find member remaining or due ammount
		$paid_amount = html_escape($this->input->post('pammount'));
		$due_ammount = $rate - $paid_amount;

		$invoice_str =  random_string('alpha', 8);
		$birthdayDate = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');


		$data_his = array(
			'member_reg_id' => html_escape($this->input->post('membership_id')),
			'invoice' => html_escape($invoice_str),
			'member_plan_id'  => html_escape($plan_id),
			'member_his_exp_date'  => html_escape($member_exp_date),
			'member_his_pay_date'  => html_escape($member_payment_date),
			'plan_total_amount' => html_escape($rate),
			'member_paid_amount' => html_escape($paid_amount),
			'member_payable_amount' => html_escape($due_ammount)
		 );
		  
		 $insert_data_his = $this->db->insert('member_histroy', $data_his);

		// insert into database member_reg table
		$data = array(
			'member_reg_id' => html_escape($this->input->post('membership_id')),
			'invoice_id' => html_escape($invoice_str),
			'member_name' => html_escape($this->input->post('name')),
			'member_birthday_date' => html_escape($birthdayDate),
			'member_email'  => html_escape($this->input->post('email')),
			'member_proof'  => html_escape($this->input->post('proofgiven')),
			'member_age'  => html_escape($this->input->post('age')),
			'member_sex'  => html_escape($this->input->post('sex')),
			'member_address'  => html_escape($this->input->post('address')),
			'member_contact'  => html_escape($this->input->post('contact')),
			'member_height'  => html_escape($this->input->post('height')),
			'member_weight'  => html_escape($this->input->post('weight')),
			'member_notes'  => html_escape($this->input->post('notes')),
			'member_plan_id'  => html_escape($this->input->post('plan')),
			'member_exp_date' => html_escape($member_exp_date),
			'plan_total_amount' => html_escape($rate),
			'member_paid_amount' => html_escape($paid_amount),
			'member_payable_amount' => html_escape($due_ammount),
			'member_payment_date' => html_escape($member_payment_date),
			'member_img' => $this->img_path
		 );
		 $insert_data =  $this->db->set('member_join_date', 'NOW()', FALSE);
		 $insert_data = $this->db->insert('member_reg', $data);
		 return $insert_data;
	}
    
    //Get Member By ID
	 public function get_member_by_id($member_id)
	 {
	 	$this->db->where('member_reg_id',$member_id);
	 	$query = $this->db->get('member_reg');

	 	if($query->num_rows() > 0)
	 	{
	 		return $query->result();
	 	}else
	 	{
	 		return NULL;
	 	}
	 }
        
    //Update Member
	 public function update_member($member_reg_id) 
	 {
	 	// To delete previous img from folder
	 	$get_img_path = $this->db->where('member_reg_id', $member_reg_id);
	 	$get_img_path = $this->db->get('member_reg');
	 	$path = $get_img_path->row(3)->member_img;
		unlink("images/".$path);
		$birthdayDate = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
	 	
	 	$data = array( 
	 		'member_name' => html_escape($this->input->post('name')),
	 		'member_email'  => html_escape($this->input->post('email')),
	 		'member_proof'  => html_escape($this->input->post('proofgiven')),
	 		'member_age'  => html_escape($this->input->post('age')),
	 		'member_sex'  => html_escape($this->input->post('sex')),
	 		'member_address'  => html_escape($this->input->post('address')),
	 		'member_contact'  => html_escape($this->input->post('contact')),
	 		'member_height'  => html_escape($this->input->post('height')),
			'member_weight'  => html_escape($this->input->post('weight')),
			'member_birthday_date' => html_escape($birthdayDate),
			'member_notes'  => html_escape($this->input->post('notes')),
	 		'member_img' => $this->img_path
	 	);
	 	$this->db->where('member_reg_id' , $member_reg_id);
	 	$this->db->update('member_reg',$data);
	 	return TRUE;
	 }
  }
?>