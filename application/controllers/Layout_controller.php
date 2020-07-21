<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Layout_controller extends CI_Controller {
    
    //Display Settings Form
	public function index()
	{	
		$data['gym_settings'] = $this->layout_model->get_gym_settings();
		$data['main_view'] = "layout_view";
		$this->load->view('layouts/main', $data);
	}
    
    //To Update Brand Name
	public function update_brand()
	{
		$gym_details = html_escape($this->input->post());
		$this->layout_model->update_brand($gym_details);
		if($this->layout_model->update_brand($gym_details))
		{
			redirect('layout_controller');
		}
	}
    
    //To Update Gym Rules
	public function update_rules()
	{
		$gym_rules = html_escape($this->input->post());
		$this->layout_model->update_rules($gym_rules);
		if($this->layout_model->update_rules($gym_rules))
		{
			redirect('layout_controller');
		}
	}
    
    //To Update Logo
	public function update_logo()
	{
		$config['upload_path']          = './images/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 460;
		$config['max_height']           = 275;

		$this->load->library('upload', $config);
		 
		if ( ! $this->upload->do_upload('brandlogo'))
		{
    		$data = array('error' => $this->upload->display_errors());
    		$data['gym_settings'] = $this->layout_model->get_gym_settings();
    		$data['main_view'] = "layout_view";
    		$this->load->view('layouts/main', $data);
		}
		else
		{
    		$data = $this->upload->data();
    		$image_path = $data['raw_name'].$data['file_ext'];
    
    		$this->layout_model->set('img_path',$image_path);
    		if($this->layout_model->update_logo())
    		{
    		     redirect('layout_controller');
    		}
		}	 
	}
  }
?>