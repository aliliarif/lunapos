<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historia_controller extends CI_Controller {

	public function index()
	{
		$this->load->model('izlezi_model');
		
		$action = $this->input->get('historia');
		$selected = $this->input->get('selected');
	

		if ($action == 1 && $selected != 1){ // historia pa zgjedh
			$data['koha_fjale'] = 'Sot';
			$data['menyra_fjale'] = 'Te gjitha';
			$data['selected_koha'] = 0;
			$data['selected_menyra'] = 999;
			$load = "historia_view";
			$data['ordersForHistory'] =  $this->izlezi_model->get_ordersForHistory('0','999');
		}else if($action == 1 && $selected == 1){
			$koha = $this->input->post('koha');
			$menyra_pageses = $this->input->post('pagesa');
			

			if($koha == '0'){
				$data['koha_fjale'] = 'Sot';
				$data['selected_koha'] = 0;
			}elseif ($koha == '7'){
				$data['koha_fjale'] = 'Javen e fundit';
				$data['selected_koha'] = 7;
			}elseif ($koha == '30'){
				$data['koha_fjale'] = 'Muajin e fundit';
				$data['selected_koha'] = 30;
			}elseif ($koha == '365'){
				$data['koha_fjale'] = 'Vitin e fundit';
				$data['selected_koha'] = 365;
			}elseif ($koha == '6000'){
				$data['koha_fjale'] = 'Gjith kohen';
				$data['selected_koha'] = 6000;
			}elseif ($koha == ''){
				$data['koha_fjale'] = 'Sot';
				$data['selected_koha'] = 0;
			}
			
			if($menyra_pageses == '1'){
				$data['menyra_fjale'] = 'Ruaj';
				$data['selected_menyra'] = 1;
			}elseif ($menyra_pageses == '2'){
				$data['menyra_fjale'] = 'Fakture';
				$data['selected_menyra'] = 2;
			}elseif($menyra_pageses == '3'){
				$data['menyra_fjale'] = 'Fletedergese';
				$data['selected_menyra'] = 3;
			}elseif ($menyra_pageses == '4'){
				$data['selected_menyra'] = 4;
				$data['menyra_fjale'] = 'Llogari fiskale';
			}elseif ($menyra_pageses == '999'){
				$data['selected_menyra'] = 999;
				$data['menyra_fjale'] = 'Te gjitha';
			}elseif ($menyra_pageses == ''){
				$data['selected_menyra'] = 999;
				$data['menyra_fjale'] = 'Te gjitha';
			}
			
			if ($koha == '' || $menyra_pageses == ''){
				$koha = 0;
				$menyra_pageses = 999;
				$data['selected_koha'] = 0;
				$data['selected_menyra'] = 999;
			}
			$load = "historia_view";
			$data['ordersForHistory'] =  $this->izlezi_model->get_ordersForHistory($koha,$menyra_pageses);
			
		}
		

		
		
		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');
		$this->load->view($load,$data);
		$this->load->view('common/js_includes');
	}

	
}

