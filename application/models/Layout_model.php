<?php
class Layout_model extends CI_Model {

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
    
    //To Get Gym Settings
	public function get_gym_settings()
	{
		$this->db->select('*');
		$query = $this->db->get('gym_settings');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
    
    // To Get Selected Currency
	public function get_currency()
	{
		$this->db->select('*');
		$query = $this->db->get('gym_settings');
		
		return $query->row(3)->currency;
	}
    
    //Update Brand Name and Description
	public function update_brand($gym_details)
	{
		$data = array(
			'brand_name' => html_escape($gym_details['brandname']),
			'brand_description' => html_escape($gym_details['branddescription']),
			'country_name' => html_escape($gym_details['country']),
			'city_name' => html_escape($gym_details['city']),
			'phone_num' => html_escape($gym_details['phone']),
			'currency' => html_escape($gym_details['currency'])
		);
		$this->db->update('gym_settings', $data);
		return TRUE;
	}
    
    //Update gym rules
	public function update_rules($gym_rules)
	{
		$data = array(
			'rule_1' => html_escape($gym_rules['rule1']),
			'rule_2' => html_escape($gym_rules['rule2']),
			'rule_3' => html_escape($gym_rules['rule3']),
			'rule_4' => html_escape($gym_rules['rule4']),
			'rule_5' => html_escape($gym_rules['rule5']),
			'rule_6' => html_escape($gym_rules['rule6'])
		);
		$this->db->update('gym_settings', $data);
		return TRUE;
	}
    
    //Update the logo of club
	public function update_logo()
	{
		//To delete previous img from folder
		$get_img_path = $this->db->get('gym_settings');
		$path = $get_img_path->row(12)->logo_img;
		unlink("images/".$path);

		$data = array(
			'logo_img' => $this->img_path
		);

		$this->db->update('gym_settings', $data);
		return TRUE;
	}
 }
?>