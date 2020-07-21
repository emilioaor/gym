<?php
class Overview_model extends CI_Model {

	//for members_per_month
	private $from;
	private $to;

	//for income_per_month
	private $i_from;
	private $i_to;

	//Pagination limit and search keyword
	private $limit;
	private $start;
	private $search_keyword;
	
	public function get($name)
	{
	    return $this->$name;
	}

	//USED TO WRITE THE VALUE OF PROPERTY
	public function set($name, $value)
	{
	    $this->$name = $value;
	}

	//Overview of Members in Member_reg Table
	public function date_range()
	{
		$this->db->limit($this->limit, $this->start);
		$this->db->select('*');
		$this->db->from('member_reg');
		$this->db->where('member_join_date >=',$this->from);
		$this->db->where('member_join_date <=',$this->to);
		$query = $this->db->get();
		if($query->num_rows() > 0 )
		{
			return $query->result();
		} 
		else 
		{
			return NULL;
		}
	}
    
    //Count Total Rows in Member_reg Table
	public function get_total_mem_rows()
	{
		$this->db->select('*');
		$this->db->from('member_reg');
		$this->db->where('member_join_date >=',$this->from);
		$this->db->where('member_join_date <=',$this->to);
		$query = $this->db->get();
		return $query->num_rows();
	}

	//Search rows from Table like to the Value Entered in Search Input Field
	public function search_tag()
	{
	   $this->db->select('*');
	   $this->db->from('member_reg');
	   $this->db->where('member_join_date >=',$this->from);
	   $this->db->where('member_join_date <=',$this->to);
	   $this->db->like('member_name',$this->search_keyword);
	   $query = $this->db->get();
	   return $query->result();
	}
	 

	//For Payment  in income_per_month_controller
	public function  payment_overview()
	{ 
		$this->db->limit($this->limit, $this->start);
		$select = array('member_histroy.*',' member_reg.member_name');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->join('member_reg','member_histroy.member_reg_id = member_reg.member_reg_id');
		$this->db->where('member_histroy.member_his_pay_date >=',$this->i_from);
		$this->db->where('member_histroy.member_his_pay_date <=',$this->i_to);
		$query = $this->db->get();
		if($query->num_rows() > 0 )
		{
			return $query->result();
		} else 
		{
			return NULL;
		}
	}
	
	//For Total Paymnet in income_per_month_controller
	public function  total_pay_amount()
	{ 
		$select = array('member_histroy.member_paid_amount');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->where('member_histroy.member_his_pay_date >=',$this->i_from);
		$this->db->where('member_histroy.member_his_pay_date <=',$this->i_to);
		$query = $this->db->get();
		if($query->num_rows() > 0 )
		{
			return $query->result();
		} else 
		{
			return NULL;
		}
	}

	//For Search in income_per_month_controller
	public function pay_search_tag()
	{
		$select = array('member_histroy.*',' member_reg.member_name');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->join('member_reg','member_histroy.member_reg_id = member_reg.member_reg_id');
		$this->db->where('member_histroy.member_his_pay_date >=',$this->i_from);
		$this->db->where('member_histroy.member_his_pay_date <=',$this->i_to);
		$this->db->like('member_name',$this->search_keyword);
		$query = $this->db->get();
		return $query->result();
	}

	//For Total rows in income_per_month_controller
	public function get_total_pay_rows()
	{
		$select = array('member_histroy.*',' member_reg.member_name');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->join('member_reg','member_histroy.member_reg_id = member_reg.member_reg_id');
		$this->db->where('member_histroy.member_his_pay_date >=',$this->i_from);
		$this->db->where('member_histroy.member_his_pay_date <=',$this->i_to);
		$query = $this->db->get();
		return $query->num_rows();
	}
  }
?>