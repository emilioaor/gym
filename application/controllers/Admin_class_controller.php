<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_class_controller extends CI_Controller {
    

	public function index()
    {
        $data['main_view'] = "admin_classes_view";
        $data['data'] = $this->class_model->class_today();

        $this->load->view('layouts/main', $data);
    }
}
