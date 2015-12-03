<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	public function index()
	{
		if (isset($_POST['login_btn'])){
			$user = $this->input->post("user");
			$password = $this->input->post("password");
			$this->load->model('users_model');
			$logged_user = $this->users_model->sel_user($user,$password);
			if(count($logged_user) == 1){
				// check if logged user is admin
				foreach ($logged_user as $user ) {
					$admin = $user->admin;
					$id_user = $user->id_user;
					$username = $user->name_user;
				}

				$this->session->set_userdata('username',$username);
				$this->session->set_userdata('id_user',$id_user);
				$this->session->set_userdata('admin',"1"); // change this

				$this->load->view('common/css_includes');
				$this->load->view('common/header_html');

				// must pass komintenti and artikli cus is directly loaded the view
				$this->load->model('artikli_model');
				$this->load->model('komintenti_model');
				$data['artikli'] =  $this->artikli_model->sel_artikli();
				$data['komintenti'] =  $this->komintenti_model->sel_komintenti();

				$this->load->view('index_view',$data); 
				$this->load->view('common/js_includes');

			}else{
				$data['error_login'] =  "Ky përdorues nuk egziston.";
				$this->load->view('common/css_includes');
				$this->load->view("login_view",$data);
			}
		}else{

			if (isset($_GET['logout']) && $_GET['logout'] == 1){
				$this->session->unset_userdata('user');
				$this->session->unset_userdata('admin');
			}
			$this->load->view('common/css_includes');
			$this->load->view("login_view");
		}
	}
}