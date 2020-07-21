<?php
class Payment_model extends CI_Model {

	//Pagination limit and search keyword
	private $limit;
	private $start;
	private $search_keyword;
	
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
    
    //To Add Payments
	public function add_payment()
 	{
 		$member_reg_id = html_escape($this->input->post('member_id'));
 		//to get plan id and rates from plan table
 		$plan_id = ($this->input->post('plan'));

 		$get_plan_detail = $this->db->where('plan_id', $plan_id);
 		$get_plan_detail = $this->db->get('plans');
 		$days = $get_plan_detail->row(3)->plan_days;
 		$rate =  $get_plan_detail->row(4)->plan_rate;
 		
 		// Auto generate the invoice id
 		$invoice_id = random_string('alpha', 8);
 		// to find the expiry date
 		$member_payment_date =  html_escape($this->input->post('pay_date'));
 		$member_exp_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($member_payment_date)) ."+". $days."day"));

 		// To find member remaining or due ammount
 		$paid_amount = html_escape($this->input->post('pamount'));
 		$due_ammount = $rate - $paid_amount;

 		$data_his = array(
 			'member_reg_id' => html_escape($member_reg_id),
 			'member_plan_id'  => html_escape($plan_id),
 			'member_his_exp_date'  => html_escape($member_exp_date),
 			'member_his_pay_date'  => html_escape($member_payment_date),
 			'plan_total_amount' => html_escape($rate),
 			'member_paid_amount' => html_escape($paid_amount),
 			'invoice' => html_escape($invoice_id),
 			'member_payable_amount' => html_escape($due_ammount),
 		 );
 		  
 		 $insert_data_his = $this->db->insert('member_histroy', $data_his);

 		// update into database member_reg table
 		$data = array(
 			'member_plan_id'  => html_escape($plan_id),
 			'invoice_id' => html_escape($invoice_id),
 			'member_exp_date' => html_escape($member_exp_date),
 			'plan_total_amount' => html_escape($rate),
 			'member_paid_amount' => html_escape($paid_amount),
 			'member_payable_amount' => html_escape($due_ammount),
 			'member_payment_date' => html_escape($member_payment_date)
 		 );
 		 $this->db->where('member_reg_id', $member_reg_id);
 		 $insert_data = $this->db->update('member_reg', $data);
 		 return $insert_data;
 	}
 	
    //To Get all Members  	
	public function get_all_members()
	{
		$this->db->select('member_reg.*,plans.plan_name');
        $this->db->from('member_reg');
        $this->db->join('plans','member_reg.member_plan_id = plans.plan_id');
		$query = $this->db->get();
		if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return NULL;
        }
	}
    
    // To Get Payable Memebrs
	public function get_payable_members()
	{
		$this->db->limit($this->limit, $this->start);
		$select = array('member_histroy.*','plans.plan_name','member_reg.member_reg_id ',' member_reg.member_name','member_reg.member_img');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->where('member_histroy.member_payable_amount >', 0);
		$this->db->join('plans','member_histroy.member_plan_id = plans.plan_id');
		$this->db->join('member_reg','member_histroy.member_reg_id = member_reg.member_reg_id');
		 
		$query = $this->db->get();
		if($query->num_rows() > 0 )
		{
			return $query->result();
		} else 
		{
			return NULL;
		}
	}	
	
	//Count Total rows from Member_reg
	public function get_total_mem_rows()
	{
		$select = array('member_histroy.*','plans.plan_name','member_reg.member_reg_id ',' member_reg.member_name','member_reg.member_img');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->where('member_histroy.member_payable_amount >', 0);
		$this->db->join('plans','member_histroy.member_plan_id = plans.plan_id');
		$this->db->join('member_reg','member_histroy.member_reg_id = member_reg.member_reg_id');
		 
		$query = $this->db->get();
		return $query->num_rows();
		 
	}	
    
    //Search the Members
	public function search_tag()
	{
		$select = array('member_histroy.*','plans.plan_name','member_reg.member_reg_id ',' member_reg.member_name','member_reg.member_img');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->where('member_histroy.member_payable_amount >', 0);
		$this->db->join('plans','member_histroy.member_plan_id = plans.plan_id');
		$this->db->join('member_reg','member_histroy.member_reg_id = member_reg.member_reg_id');
	    $query = $this->db->get();
	    return $query->result();
	}
    
    //To Get Members
	public function get_member($member_id)
	{
		$this->db->where('member_reg_id', $member_id);
		$query = $this->db->get('member_reg');
		if($query->num_rows() > 0)
	    {
	        return $query->result();
	    }
	    else
	    {
	        return NULL;
	    }
	}
    
    //To Get Members and Plans
	public function get_member_and_plan($invoice_id)
	{
		$this->db->select('*');
        $this->db->from('member_histroy');
        
        $this->db->where('member_histroy.invoice', $invoice_id);

        $this->db->join('plans','member_histroy.member_plan_id = plans.plan_id');
 
		$query = $this->db->get();
		if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return NULL;
        }
	}
    
    //Pay Balance
	public function pay_balance($invoice_id)
	{
		$total_amount =  html_escape($this->input->post('total'));
		$paid_amount =  html_escape($this->input->post('paid'));

		$balance = $total_amount -  $paid_amount;

		$data = array(
			'member_paid_amount' => $paid_amount,
			'member_payable_amount' => $balance
		);

		// To update in member reg table
		$member_reg = $this->db->where('invoice_id', $invoice_id);
		$member_reg = $this->db->update('member_reg', $data);

		// To update in member hisroy table
		$query = $this->db->where('invoice', $invoice_id);
		$query = $this->db->update('member_histroy', $data);
		return TRUE;
	}
}