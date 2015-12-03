<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izlezi_controller extends CI_Controller {

	public function index()
	{
		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');

		$this->load->view('izlezi_view');

		$this->load->view('common/js_includes');
	}

	// called from ajax in vlezovi.js
	public function get_iz_fakturi_hd(){
		$this->load->model('izlezi_model');
		$vlezovi_json = $this->izlezi_model->sel_iz_fakturi_hd_JSON();
	}
	// called from ajax in vlezovi.js
	public function get_iz_fakturi_clenovi(){
		$id_iz_fakt = $this->input->get('broj_faktura');
		$this->load->model('izlezi_model');
		$vlezovi_json = $this->izlezi_model->sel_iz_fakturi_clenovi_JSON($id_iz_fakt);
	}

}

/* End of file izlezi_controller.php */
/* Location: ./application/controllers/izlezi_controller.php */