<?php
class Register_user_model extends CI_Model {
    
    // Variables
	private $user_id;
	
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
    
    // To Get users
	public function get_user()
	{
		$this->db->where('user_id', $this->user_id);
		$query = $this->db->get('register_user');
		return $query->result();
	}
	
	//Create User
	 public function create_user()
	 {
	 	$option = ['cost' => 12];
	 	$encripted_pass = password_hash($this->input->post('password') ,  PASSWORD_BCRYPT , $option);
	 	$user_data = array(
	 		'first_name' => html_escape($this->input->post('firstname')),
	 		'user_password' => html_escape($encripted_pass) ,
	 		'last_name' => html_escape($this->input->post('lastname')),
	 		'user_email' => html_escape($this->input->post('useremail'))
	 	);
	 	$insert_data = $this->db->insert('register_user', $user_data);
	 	return $insert_data;
	 }

	 // Login User into dashboard
	 public function login()
	 {
	 	$email = html_escape($this->input->post('useremail'));
	 	$password = html_escape($this->input->post('userpassword'));
	 	$this->db->where('user_email', $email);
	 	$result = $this->db->get('register_user');

	 	$db_password = $result->row(4)->user_password;

	 	if(password_verify($password, $db_password))
	 	{
	 		return $result->row(0)->user_id;
	 	} 
	 	else 
	 	{
	 		return FALSE;
	 	}
	 }

    public function login_by_email_or_phone()
    {
        $email = html_escape($this->input->post('useremail'));
        $password = html_escape($this->input->post('userpassword'));

        $user = $this->get_user_by_phone($email);

        if (! $user) {
            $user = $this->get_user_by_email($email);
        }

        if (! $user) {
            return false;
        }

        $db_password = $user->user_password;

        if (password_verify($password, $db_password)) {
            return $user->user_id;
        }

        return false;
    }

    public function get_user_by_phone($phone)
    {
        $this->db->select('register_user.*');
        $this->db->from('register_user');
        $this->db->join('member_reg', 'member_reg.member_email = register_user.user_email');
        $this->db->where('member_reg.member_contact', $phone);

        return $this->db->get()->row(0);
    }

    public function get_user_by_email($email)
    {
        $this->db->select('register_user.*');
        $this->db->from('register_user');
        $this->db->where('user_email', $email);

        return $this->db->get()->row(0);
    }
}
