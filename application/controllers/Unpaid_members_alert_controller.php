<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unpaid_members_alert_controller extends CI_Controller {
    
    //Show Unpaid Members
	public function index()
	{
		if(html_escape($this->input->post('keyword')) == NULL)
		{
		    $this->page();
		    $limit_per_page = 15;
		    $start = $this->uri->segment(3);
		    $this->payment_model->set('limit',$limit_per_page);
		    $this->payment_model->set('start',$start);

		    $data['members'] = $this->payment_model->get_payable_members();
		    $datakey = array(
		    'key'  => 'show',
		    );
		    $this->session->set_userdata('key', $datakey);

		    //Run This Code if Input field is available
		} 
		else 
		{
		    $keys = html_escape($this->input->post('keyword'));
		    $this->payment_model->set('search_keyword',$keys);
		    $data['members'] = $this->payment_model->search_tag();
		}

		$data['currecny'] = $this->layout_model->get_currency();
		$data['members'] = $this->payment_model->get_payable_members();
		$data['main_view'] = "unpaid_members_alert_view";
		$this->load->view('layouts/main', $data);
	}
	
    //Load Pagianation
	public function page()
	{
	    $query2 = $this->payment_model->get_total_mem_rows();

	    //Pagination library
	    $this->load->library('pagination');

	    //Codeigniter Pagination
	    $config['base_url'] = base_url('unpaid_members_alert_controller/index');
	    $config['total_rows'] = $query2;
	    $config['per_page'] = 15;

	    //bootstrap styling
	    $config['full_tag_open'] = '<ul class="pagination justify-content-end m-0 pt-2 pb-2 ">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li class="page-item">';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tag_close'] = '</li>';
	    $config['first_link'] = 'First';
	    $config['last_link'] = 'Last';
	    $config['next_link'] = 'Next';
	    $config['prev_link'] = 'Previous';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li class="page-item">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li class="page-item ">';
	    $config['last_tag_close'] = '</a></li>';
	    $config['attributes'] = array('class' => 'page-link ');

	    //Pagination  Initiliazation
	    $this->pagination->initialize($config);
	}
}
