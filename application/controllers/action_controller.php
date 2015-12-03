<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Action_controller extends CI_Controller {
	// FISKALLNA,STORNA DHE RUAJ RUHEN VETEM NE smetka_hd dhe smetki_clenovi
	public function index(){
		date_default_timezone_set('Europe/Skopje');
		$nr_products = $this->input->post("nr_porosive");
		$id_komintent = $this->input->post("bleresi_table_1");

		// nese osht fiskalna dem duhen -- fiskalna_modal thiret me kto parametra, ruhet krejt porosia ne ARRAY
		$naracka_naziv_artikli = array();
		$naracka_kolicina = array();
		$naracka_cena = array();
		$naracka_popust = array();

		if ($id_komintent == ''){
			$id_komintent = "NULL";
		}
		$iznos = $this->input->post("totali");
		$datum = date('Y-m-d h:i:s');
		$tip_plakanje = '';
		$nedostatok_zaliha = 0;

		if (isset($_POST['ruaj_btn'])){
			$tip_plakanje = 0;
		}else if(isset($_POST['fakture_btn'])){
			$tip_plakanje = 1;
		}else if(isset($_POST['ispratnic_btn'])){
			$tip_plakanje = 2;
		}else if(isset($_POST['fiskale_btn'])){
			$tip_plakanje = 3;
		}else if(isset($_POST['storna_btn'])){
			$tip_plakanje = 4;
		}

		$this->load->model('smetki_model');
		$this->load->model('fakturi_model');
		$this->load->model('ispratnici_model');
		$this->load->model('zaliha_model');
		$this->load->model('artikli_model');

		// max broj_smtk
		$broj_smtk = $this->smetki_model->sel_maxBroj_smtk($datum) + 1;

		$this->db->trans_start(); // TRANSATCTION

		// ins smetki_hd 
		$this->smetki_model->ins_smetki_hd($broj_smtk,$tip_plakanje,$iznos,$datum,$id_komintent);

		if ($tip_plakanje == 1){ // FAKTURE
			$broj_faktura = $this->fakturi_model->sel_maxBroj_fakt($datum) + 1;
			// ins fakturi_hd
			$this->fakturi_model->ins_fakturi_hd($broj_faktura,$iznos,$datum,$id_komintent,$broj_smtk);
			$data['tip_plakanje'] =  "fakture"; // i need this to open print window - used by print_js.php
		}else if ($tip_plakanje == 2 || $tip_plakanje == 3){ // ISPRATNIC ILI FISKALNA -- (GENERIRAJ ISPRATNICA I KOGA E KLIKNATO FISKALNA)
			$broj_ispratnica = $this->ispratnici_model->sel_maxBroj_ispr($datum) + 1;
			// ins ispratnici_hd
			$this->ispratnici_model->ins_ispratnici_hd($broj_ispratnica,$iznos,$datum,$id_komintent,$broj_smtk);
			$data['tip_plakanje'] =  "ispratnic"; // i need this to open print window - used by print_js.php
		}

		// ins smetki_clenovi
		$this->load->model('ddv_model');
		for($i=1; $i<=$nr_products; $i++){
			$sifra_artikal = $this->input->post("sifra_artikal_table_".$i);
			$cena = $this->input->post("product_price_table_".$i);
			$kolicina = $this->input->post("quantity_table_".$i);
			$reden_broj = $i;
			$popust = $this->input->post("discount_table_".$i);
			if($popust == ''){
				$popust = 0;
			}
			$ddv = $this->ddv_model->sel_ddv($sifra_artikal);
			$ddv_vrednost = $cena * ($ddv / 100);

			if ($tip_plakanje == 1){ // FAKTURE
				// ins fakturi_clenovi
				$this->fakturi_model->ins_fakturi_clenovi($broj_faktura,$sifra_artikal,$cena,$ddv_vrednost,$popust,$kolicina,$reden_broj);
			}else if ($tip_plakanje == 2){ // ISPRATNIC
				// ins ispratnici_clenovi
				$this->ispratnici_model->ins_ispratnici_clenovi($broj_ispratnica,$sifra_artikal,$cena,$ddv_vrednost,$popust,$kolicina,$reden_broj);
			}else if($tip_plakanje == 3){ // FISKALNA
				// se generira i ISPRATNICA za pecatenata fiskalna
				$this->ispratnici_model->ins_ispratnici_clenovi($broj_ispratnica,$sifra_artikal,$cena,$ddv_vrednost,$popust,$kolicina,$reden_broj);
				// get NAZIV na artikal.
				$naziv_artikal = $this->artikli_model->sel_naziv_artikal($sifra_artikal);
				array_push($naracka_naziv_artikli,$naziv_artikal);
				array_push($naracka_cena,$cena);
				array_push($naracka_kolicina,$kolicina);
				array_push($naracka_popust, $popust);
				// de duhet ene ddv-ja te dergohet per DDV OBVRZNICI
			}

			$this->smetki_model->ins_smetki_clenovi($broj_smtk,$sifra_artikal,$cena,$ddv_vrednost,$popust,$kolicina,$reden_broj);
			
			// UPDATE ZALIHA // odzemi
			$this->zaliha_model->upd_zaliha($sifra_artikal,$kolicina);
		}

		$this->db->trans_complete(); // TRANSATCTION END

		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');

		$this->load->model('artikli_model');
		$this->load->model('komintenti_model');
		$data['artikli'] =  $this->artikli_model->sel_artikli();
		$data['komintenti'] =  $this->komintenti_model->sel_komintenti();

		$this->load->view('index_view',$data);
		if($tip_plakanje == 1){ // FAKTURE
			$this->generirajFaktura($broj_faktura,$datum,$id_komintent);			
		}else if($tip_plakanje == 2){ // ISPRATNIC
			$this->generirajIsprtanica($broj_ispratnica,$datum,$id_komintent);
		}else if($tip_plakanje == 3){ // FISKALNA
			$this->generirajFiskalna($naracka_naziv_artikli,$naracka_cena,$naracka_kolicina,$naracka_popust);
			// GENERIRAJ ISPRATNICA I ZA PECATENATA FISKALNA
			$this->generirajIsprtanica($broj_ispratnica,$datum,$id_komintent);
		}
		$this->load->view('common/js_includes');
		$this->load->view('common/print_js');
	}

	public function generirajFaktura($broj_faktura,$datum,$id_komintent){
		// select detali za komintentot
		$this->load->model('komintenti_model');
		$query_komintent_details = $this->komintenti_model->sel_komintent_detail($id_komintent);

		foreach ($query_komintent_details as $komintent_details) {
			$data['ime_komintent'] = $komintent_details->ime_komintent;
			$data['grad_komintent'] = $komintent_details->ime_grad;
		}
		$data['broj_faktura'] = $broj_faktura;

   		$datum_formated = date ( 'd/m/Y', time () );
		$data['datum'] = $datum_formated;
		
		// select faktura CLENOVI and its details
		$data['faktura'] = $this->fakturi_model->sel_faktura($broj_faktura,$datum);

		// debugg
		// foreach ($faktura_details as $fd) {
		// 	echo $fd->cena;
		// }
		//exit();
		$this->load->view('fakture_view',$data);
	}

	public function generirajIsprtanica($broj_ispratnica,$datum,$id_komintent){
		// select detali za komintentot
		$this->load->model('komintenti_model');
		$query_komintent_details = $this->komintenti_model->sel_komintent_detail($id_komintent);

		foreach ($query_komintent_details as $komintent_details) {
			$data['ime_komintent'] = $komintent_details->ime_komintent;
			$data['grad_komintent'] = $komintent_details->ime_grad;
		}
		$data['broj_ispratnica'] = $broj_ispratnica;

		// select ispratnica CLENOVI and its details
		$data['ispratnica'] = $this->ispratnici_model->sel_ispratnica($broj_ispratnica,$datum);
		$this->load->view('ispratnic_view',$data);
	}

	public function generirajFiskalna($naracka_naziv_artikli,$naracka_cena,$naracka_kolicina,$naracka_popust){
		$this->load->model('fiskalna_model');
		$this->fiskalna_model->fiskallna_smetka($naracka_naziv_artikli,$naracka_cena,$naracka_kolicina,$naracka_popust);
	}
}