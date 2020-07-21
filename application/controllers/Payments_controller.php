<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payments_controller extends CI_Controller {
    
    //View Payment Form
	public function index()
	{
		if(html_escape($this->input->post('keyword'))== NULL)
		{
		    $this->page();
		    $limit_per_page = 15;
		    $start = $this->uri->segment(3);
		    $this->members_model->set('limit',$limit_per_page);
		    $this->members_model->set('start',$start);

		    $data['members'] = $this->members_model->get_all_members();
		    $datakey = array(
		    'key'  => 'show',
		    );
		    $this->session->set_userdata('key', $datakey);

		    //Run This Code if Input field is available
		} 
		else 
		{
		    $keys = html_escape($this->input->post('keyword'));
		    $this->members_model->set('search_keyword',$keys);
		    $data['members'] = $this->members_model->search_tag();
		}

		$data['main_view'] = "payments_view";
		$this->load->view('layouts/main', $data);	
	}

    //Load Pagination
	public function page()
	{
	    $query2 = $this->members_model->get_total_mem_rows();

	    //Pagination library
	    $this->load->library('pagination');

	    //Codeigniter Pagination
	    $config['base_url'] = base_url('payments_controller/index');
	    $config['total_rows'] = $query2;
	    $config['per_page'] = 15;

	    ///bootstrap styling
	    $config['full_tag_open'] = '<ul class="pagination justify-content-end m-0 pb-2 pt-2">';
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
