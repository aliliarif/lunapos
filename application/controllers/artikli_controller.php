<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikli_controller extends CI_Controller {

	public function index()
	{
		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');

		$this->load->model('artikli_model');
		
		if ($this->input->get('add_artikal')){ // load view
			$this->load->view('add_artikli_view');
		}else if($this->input->post('insert_artikal')){  // must set value = 'insert_artikal' to catch POST
			$this->add_artikal();
		}else if($this->input->post('upd_artikal')){
			$upd_sifra_artikal = $this->input->post('hid_sifra_artikal'); // from hidden input
			$this->upd_artikal($upd_sifra_artikal);
		}
		else{
			$data['artikli'] = $this->artikli_model->sel_artikli();
			$this->load->view('artikli_view',$data);
		}
		$this->load->view('common/js_includes');
	}

	public function add_artikal(){
		$datum = date('Y-m-d h:i:s');
		$naziv_artikal = $this->input->post('naziv_artikal');
		$nabavna_so_ddv = $this->input->post('nabavna_so_ddv');
		$ddv = $this->input->post('ddv');
		$marza = $this->input->post('marza');
		$ed_merka = $this->input->post('ed_merka');
		$interna_sifra = $this->input->post('interna_sifra');
		$kolicina_pak = $this->input->post('kolicina_pak');
		$prodazna_cena = $this->input->post('prodazna_cena');
		
		$nabavna_bez_ddv = $this->input->post('nabavna_bez_ddv'); // sperdoret askund, samo za prikaz

		

		// echo $interna_sifra;exit();
		// FORM VALIDATION
		$this->form_validation->set_rules('naziv_artikal', 'Emrin e artikullit', 'required|is_unique[artikli.naziv_artikal]');
		$this->form_validation->set_rules('nabavna_so_ddv', 'Cmimin blerës', 'required');
		$this->form_validation->set_rules('ddv', 'TVSH-në', 'required');
		$this->form_validation->set_rules('marza', 'Marzhën', 'required');
		$this->form_validation->set_rules('ed_merka', 'Njësinë matëse', 'required');
		$this->form_validation->set_rules('interna_sifra', 'Shifrën', 'required|is_unique[artikli.interna_sifra]');
		$this->form_validation->set_rules('kolicina_pak', 'Sasinë në paketim', 'required');
		$this->form_validation->set_rules('prodazna_cena', 'Çmimin shitës', 'required');
		$this->form_validation->set_rules('nabavna_bez_ddv', 'Çmimin me TVSH', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('add_artikli_view');
		}else{
			$sifra_artikal = $this->artikli_model->sel_maxSifra_artikal() + 1;
			$this->artikli_model->ins_artikli($sifra_artikal,$naziv_artikal,$nabavna_so_ddv,$nabavna_bez_ddv,$prodazna_cena,$ddv,$marza,$ed_merka,0,$datum,$interna_sifra,$kolicina_pak);
			$data['success_article'] = "Artikulli " . 	$naziv_artikal . " u shtua";
			$this->load->view('add_artikli_view',$data);
		}		
	}

	public function upd_artikal($sifra_artikal){

		// NEED FORM VALIDATION ...!!... CHANGE THIS ASAP
		$naziv_artikal = $this->input->post('naziv_artikal');
		$nabavna_so_ddv = $this->input->post('nabavna_so_ddv');
		$ddv = $this->input->post('ddv');
		$marza = $this->input->post('marza');
		$ed_merka = $this->input->post('ed_merka');
		$interna_sifra = $this->input->post('interna_sifra');
		$kolicina_pak = $this->input->post('kolicina_pak');
		$prodazna_cena = $this->input->post('prodazna_cena');
		$nabavna_bez_ddv = $this->input->post('nabavna_bez_ddv');
		
		$this->artikli_model->upd_artikal($sifra_artikal,$naziv_artikal,$nabavna_so_ddv,$nabavna_bez_ddv,$ddv,$marza,$ed_merka,$interna_sifra,$kolicina_pak,$prodazna_cena,$nabavna_bez_ddv);
		$data['artikli'] = $this->artikli_model->sel_artikli();
		$this->load->view('artikli_view',$data);
	}
}