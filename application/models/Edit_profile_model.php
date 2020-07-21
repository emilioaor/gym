<?php
class Edit_profile_model extends CI_Model {
	
    //To Set id
	private $id;

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
    
    //To Get User
	public function get_user()
	{
		$this->db->where('user_id' , $this->id);
		$query = $this->db->get('register_user');
		return $query->result();
	}
	
	//To Update Profile
	public function update_profile($user_id )
	{
		$option = ['cost' => 12];
	 	$encripted_pass = password_hash($this->input->post('password') ,  PASSWORD_BCRYPT , $option);
		$data = array(
			'first_name' => html_escape($this->input->post('firstname')),
			'last_name' => html_escape($this->input->post('lastname')),
			'user_password' => html_escape($encripted_pass),
			'user_email' => html_escape($this->input->post('useremail'))
		);
		$this->db->where('user_id' , $user_id);
		$this->db->update('register_user',$data);
		return TRUE;
	}
}
?>