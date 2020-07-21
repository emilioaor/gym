<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Income_per_month_controller extends CI_Controller {
    
    //Starting Sessions to find income
	public function index()
	{
		//Using sessions for searching and paginating
		$i_from = "";
		$i_to =	 "";

		if(html_escape($this->input->post('i_from')) != NULL ){
		  $i_from = html_escape($this->input->post('i_from'));
		  $i_to = html_escape($this->input->post('i_to'));
		  $i_data = array(
		  	'i_from' => $i_from,
		  	'i_to' => $i_to
		  );
		  $this->session->set_userdata($i_data);
		}
		else
		{
		  if($this->session->userdata('i_from') != NULL)
		  {
		  	$i_from = $this->session->userdata('i_from');
		    $i_to =$this->session->userdata('i_to');
		  }
	    }
		   
		$this->overview_model->set('i_from',$i_from);
		$this->overview_model->set('i_to',$i_to);
		
		if(html_escape($this->input->post('keyword')) == NULL)
		{
		    $this->page();
		    $limit_per_page = 15;
		    $start = $this->uri->segment(3);
		    $this->overview_model->set('limit',$limit_per_page);
		    $this->overview_model->set('start',$start);

		    $data['overview_pay'] = $this->overview_model->payment_overview();
		    $data['counts'] = $this->overview_model->get_total_pay_rows();
		    $data['payment_counts'] = $this->overview_model->total_pay_amount();
		    $datakey = array(
		    'key'  => 'show',
		    );
		    $this->session->set_userdata('key', $datakey);

		    //Run This Code if Input field is available
		} 
		else 
		{
		    $keys = html_escape($this->input->post('keyword'));
		    $this->overview_model->set('search_keyword',$keys);
		    $data['counts'] = $this->overview_model->get_total_pay_rows();
		    $data['payment_counts'] = $this->overview_model->total_pay_amount();
		    $data['overview_pay'] = $this->overview_model->pay_search_tag();
		}

		$data['currecny'] = $this->layout_model->get_currency();
		$data['main_view'] = "income_per_month_view";
		$this->load->view('layouts/main', $data);
	}
    
    //Pagination
	public function page()
	{
	    $query2 = $this->overview_model->get_total_pay_rows();

	    //Pagination library
	    $this->load->library('pagination');

	    //Codeigniter Pagination
	    $config['base_url'] = base_url('income_per_month_controller/index');
	    $config['total_rows'] = $query2;
	    $config['per_page'] = 15;

	    //bootstrap styling
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
