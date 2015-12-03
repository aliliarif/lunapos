<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komintenti_controller extends CI_Controller {

	public function index()
	{
		$this->load->model('komintenti_model');

		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');

		if ($this->input->get('add_komintent')){ // load view
			$this->load->model('gradovi_model');
			$data['gradovi'] = $this->gradovi_model->sel_gradovi();
			$this->load->view('add_komintenti_view',$data);
		}else if($this->input->post('insert_komintent')){ // must set value = 'insert_komintent' to btn to catch POST
			$this->add_komintent();
		}else{
			$data['komintenti'] = $this->komintenti_model->sel_komintenti();
			$this->load->view('komintenti_view',$data);
		}
		$this->load->view('common/js_includes');
	}

	public function add_komintent(){
		$ime_komintent = $this->input->post('ime_komintent');
		$grad_komintent = $this->input->post('grad_komintent');
		$tel_komintent = $this->input->post('tel_komintent');
		$datum = date('Y-m-d h:i:s');

		// FORM VALIDATION
		$this->form_validation->set_rules('ime_komintent', 'Emrin', 'required|is_unique[komintenti.ime_komintent]');

		if ($this->form_validation->run() == FALSE){
			$this->load->model('gradovi_model');
			$data['gradovi'] = $this->gradovi_model->sel_gradovi();
			$this->load->view('add_komintenti_view',$data);
		}else{
			$this->load->model('gradovi_model');
			$data['gradovi'] = $this->gradovi_model->sel_gradovi();
			$this->komintenti_model->ins_komintenti($ime_komintent,$tel_komintent,$grad_komintent,$datum);
			$data['success_komintent'] = "Blerësi " . $ime_komintent . " u shtua";
			$this->load->view('add_komintenti_view',$data);
		}
		
	}
}