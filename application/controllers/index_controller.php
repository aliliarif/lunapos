<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_controller extends CI_Controller {

	public function index()
	{
		
		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');
		
		$this->load->model('artikli_model');
		$this->load->model('komintenti_model');
		$data['artikli'] =  $this->artikli_model->sel_artikli();
		$data['komintenti'] =  $this->komintenti_model->sel_komintenti();
		
		$this->load->view('index_view',$data); 
		
		$this->load->view('common/js_includes');
		
	}
}

