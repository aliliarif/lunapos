<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_controller extends CI_Controller {

	public function index()
	{
		$this->load->model('users_model');

		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');

		if ($this->input->get('add_user')){ // load view
			$this->load->view("add_user_view");
		}else if($this->input->post('insert_user')){  // must set value = 'insert_user' to catch POST
			$this->add_user();
		}else{
			$data['users'] = $this->users_model->sel_all_users();
			$this->load->view("users_view",$data);
		}

		$this->load->view('common/js_includes');
		
	}

	public function add_user(){
		$name_user = $this->input->post('name_user');
		$password = $this->input->post('password');
		$admin = $this->input->post('admin');

		if($admin == 'on'){
			$admin = 1;
		}else{
			$admin = 0;
		}

		$this->form_validation->set_rules('name_user', 'Emrin', 'required|is_unique[users.name_user]');
		$this->form_validation->set_rules('password', 'Passwordin', 'required');
	
		if ($this->form_validation->run() == FALSE){
			$this->load->view('add_user_view');
		}else{
			$this->users_model->ins_users($name_user,$password,$admin);
			$data['success_user'] = "Përdoruesi me emër " . 	$name_user . " u shtua";
			$this->load->view('add_user_view',$data);
		}
	}
}