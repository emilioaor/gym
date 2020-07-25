<?php
class Members_model extends CI_Model {
	
    //Variables
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
    
    //Get all Members
	public function get_all_members()
	{
		$this->db->limit($this->limit, $this->start);
		$this->db->select('*,plans.plan_name');
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
    
    //Count Total Member from Member_reg Table 
	public function get_total_mem_rows()
	{
    	$this->db->select('member_reg.*,plans.plan_name');
        $this->db->from('member_reg');
        $this->db->join('plans','member_reg.member_plan_id = plans.plan_id');
    	$query = $this->db->get();
    	return $query->num_rows();
	}

	//Search rows from table like to the value entered in search input field
	public function search_tag()
	{
	   $this->db->select('member_reg.*,plans.plan_name');
	   $this->db->from('member_reg');
	   $this->db->join('plans','member_reg.member_plan_id = plans.plan_id');
	   $this->db->like('member_name',$this->search_keyword);
	   $query = $this->db->get();
	   return $query->result();
	}
	 
    //Get all Ending Members
	public function get_all_end_members()
	{	
		
		$this->db->select('*');
		$this->db->from('member_reg');
		$this->db->where('member_reg.member_exp_date <', date('Y-m-d'));
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
	
	//Get Member by id
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

	public function get_by_email($email)
    {
        $this->db->select('*,plans.plan_name');
        $this->db->from('member_reg');
        $this->db->join('plans','member_reg.member_plan_id = plans.plan_id');
        $this->db->where('member_email', $email);
        $query = $this->db->get();

        if ($query->num_rows()) {
            return $query->result()[0];
        }

        return null;
    }
    
    //Get Histroy of Member
	public function get_member_his($member_id)
	{
		$select = array('member_histroy.*','plans.plan_name','member_reg.member_reg_id ',' member_reg.member_name');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->where('member_histroy.member_reg_id', $member_id);
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
	
	//Get Member by invoice id
	public function get_member_his_by_invoice($mem_invoice)
	{
		$select = array('member_histroy.*','plans.plan_name','plans.plan_details','member_reg.member_reg_id ',' member_reg.member_name');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->where('member_histroy.invoice', $mem_invoice);
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
    
    //Update Invoice
	public function update_invoice($invoice_id)
	{
		//to get plan id and rates from plan table
		$plan_id = html_escape($this->input->post('plan'));
		$get_plan_detail = $this->db->where('plan_id', $plan_id);
		$get_plan_detail = $this->db->get('plans');
		$days = $get_plan_detail->row(3)->plan_days;
		$rate =  $get_plan_detail->row(4)->plan_rate;

		// to find the expiry date
		$member_payment_date = html_escape($this->input->post('p_date'));
		$member_exp_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($member_payment_date)) ."+". $days."day"));

		// To find member remaining or due ammount
		$paid_amount = html_escape($this->input->post('pammount'));
		$due_ammount = $rate - $paid_amount;

	 	$data_reg = array( 
	 		'member_payment_date'  => html_escape($member_payment_date),
	 		'member_plan_id'  => html_escape($plan_id),
	 		'plan_total_amount'  => html_escape($rate),
	 		'member_paid_amount'  => html_escape($paid_amount),
	 		'member_payable_amount' => html_escape($due_ammount),
	 		'member_exp_date' => html_escape($member_exp_date),
	 		'member_name' => html_escape($this->input->post('name'))
	 	);
	 	$this->db->where('invoice_id' , $invoice_id);
	 	$this->db->update('member_reg',$data_reg);

	 	$data_his = array( 
	 		'member_his_pay_date'  => html_escape($member_payment_date),
	 		'member_plan_id'  => html_escape($plan_id),
	 		'plan_total_amount'  => html_escape($rate),
	 		'member_paid_amount'  => html_escape($paid_amount),
	 		'member_payable_amount' => html_escape($due_ammount),
	 		'member_his_exp_date' => html_escape($member_exp_date)
	 	);
	 	$this->db->where('invoice' , $invoice_id);
	 	$this->db->update('member_histroy',$data_his);
	 	return TRUE;
	}
    
    //Delete Member and Histroy
	public function delete($member_reg_id)
	{
		// To delete from folder
		$get_img_path = $this->db->where('member_reg_id', $member_reg_id);
		$get_img_path = $this->db->get('member_reg');
		$path = $get_img_path->row(3)->member_img;
		unlink("images/".$path);

		// To delete from database
		$this->db->where('member_reg_id',$member_reg_id);
		$delete = array('member_reg','member_histroy');
		$query = $this->db->delete($delete);

		return TRUE;
	}		
    
    //Delete Member Histroy
	public function delete_his_invoice($mem_invoice)
	{
		// To delete from database
		$this->db->where('invoice',$mem_invoice);
		// $delete = array('member_histroy','member_histroy');
		$query = $this->db->delete('member_histroy');

		return TRUE;
	}
}
?>