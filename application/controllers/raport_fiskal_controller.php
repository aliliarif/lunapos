<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raport_fiskal_controller extends CI_Controller {

	public function index()
	{
		$this->load->model('fiskalna_model');

		
		if($this->input->post('raport_pa')){
			$tip = 1;
		}else if($this->input->post('hyrje_zyrtare')){
			$tip = 2;
		}else if($this->input->post('dalje_zyrtare')){
			$tip = 3;
		}else if($this->input->post('raport_shkurt')){
			$tip = 4;
		}else if($this->input->post('raport_detal')){
			$tip = 5;
		}else if($this->input->post('mbyllje_me')){
			$tip = 6;
		}		

		$this->fiskalna_model->raport_fiscal($tip);

		redirect('index_controller');
		
		// e perdori redirectin nvend ksaj
		// $this->load->view('common/css_includes');
		// $this->load->view('common/header_html');

		// $this->load->model('artikli_model');
		// $this->load->model('komintenti_model');
		// $data['artikli'] =  $this->artikli_model->sel_artikli();
		// $data['komintenti'] =  $this->komintenti_model->sel_komintenti();
		
		// $this->load->view('index_view',$data);

		// $this->load->view('common/js_includes');
		// $this->load->view('common/print_js');
	}

}

/* End of file raport_fiskal_controller.php */
/* Location: ./application/controllers/raport_fiskal_controller.php */