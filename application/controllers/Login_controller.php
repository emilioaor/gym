<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_controller extends CI_Controller {
    
    //Load Login Page
	public function index()
	{
		$this->load->view('user/login_view');
	}
}
