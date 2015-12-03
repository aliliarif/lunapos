<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vlezovi_controller extends CI_Controller {

	public function index()
	{
		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');
		$this->load->model('komintenti_model');


		if($this->input->post('pay_fakt')){
			// update vl_fakturi_hd -- set status = 1 - plateno
			$this->load->model('vl_fakturi_model');

			$br_vl_fakt = $this->input->post("vl_fakt_br");
			$vl_id_komintent = $this->input->post("vl_id_komintent");

			$this->vl_fakturi_model->upd_status($br_vl_fakt,$vl_id_komintent);
		}

		$data['komintenti'] = $this->komintenti_model->sel_komintenti();
		$this->load->view('vlezovi_view',$data);

		$this->load->view('common/js_includes');
	}
	// called from ajax in vlezovi.js
	public function get_vl_fakturi_hd(){
		$this->load->model('vl_fakturi_model');
		$vlezovi_json = $this->vl_fakturi_model->sel_vl_fakturi_hd_JSON();
	}
	// called from ajax in vlezovi.js
	public function get_vl_fakturi_clenovi(){
		$id_vl_fakt = $this->input->get('id_vl_fakt');
		$this->load->model('vl_fakturi_model');
		$vlezovi_json = $this->vl_fakturi_model->sel_vl_fakturi_clenovi_JSON($id_vl_fakt);
		
	}

}

/* End of file hyrje_controller.php */
/* Location: ./application/controllers/hyrje_controller.php */