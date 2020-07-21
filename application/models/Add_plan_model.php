<?php
class Add_plan_model extends CI_Model {

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
	
	//To Add New Plans
	public function add_plan()
	{
		$data = array(
			'plan_name' => html_escape($this->input->post('planname')),
			'plan_details'  => html_escape($this->input->post('details')),
			'plan_days'  => html_escape($this->input->post('days')),
			'plan_rate'  => html_escape($this->input->post('rate'))
		);
		$insert_data = $this->db->insert('plans', $data);
		return $insert_data;
	}
    
    //To Get Plans
	public function get_plan()
	{
		$query = $this->db->get('plans');
		return $query->result();
	}
    
    //Fetch Plan by id
	public function get_plan_by_id($plan_id)
	{
		$this->db->where('plan_id', $plan_id);
		$query = $this->db->get('plans');
		if($query->num_rows() > 0)
	    {
	        return $query->result();
	    }
	    else
	    {
	        return NULL;
	    }
	}
	
	//Edit Plan
	public function edit_plan($plan_id)
	{
		$data = array(
			'plan_name' => html_escape($this->input->post('plan_name')),
			'plan_details' => html_escape($this->input->post('plan_details')),
			'plan_days' => html_escape($this->input->post('plan_days')),
			'plan_rate' => html_escape($this->input->post('plan_rate'))
		);
		$this->db->where('plan_id' , $plan_id);
		$this->db->update('plans',$data);
		return TRUE;
	}
    
    //Delete Plans
	public function delete($plan_id)
	{
		$this->db->where('plan_id',$plan_id);
		$query =  $this->db->delete('plans');
		return TRUE;
	}
}
?>