<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_controller extends CI_Controller {
    
    //Display Admin View
	public function index()
	{
		$data['main_view'] = "member_view";

        $now = new \DateTime();
        $expDate = \DateTime::createFromFormat('Y-m-d', $this->session->userdata('member')->member_exp_date);
        $before5 = \DateTime::createFromFormat('Y-m-d', $this->session->userdata('member')->member_exp_date)->modify('-5 days');

        if ($now >= $before5) {
            $this->session->set_flashdata('alert_type', 'danger');
            $this->session->set_flashdata('alert_msg', 'Your expiration date is ' . $expDate->format('d M') . '. Please renew your subscription');
        }

		$this->load->view('layouts/main', $data);
	}
}
