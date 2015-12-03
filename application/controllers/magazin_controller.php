<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Magazin_controller extends CI_Controller {

	public function index()
	{
		if(isset($_POST['shto_FH'])){
			// foreach ($_POST as $var => $value) { 
   			//		echo "$var = $value<br>"; 
			// }exit();
			
			$this->load->model('zaliha_model');
			$this->load->model('vl_fakturi_model');
			
			$br_artikli = $this->input->post('maxFaktureHyrse');
			$id_komintent = $this->input->post('fakture_nga');
			$datum = $this->input->post('fakture_data');
			$br_vl_faktura = $this->input->post('fakture_nr');
			$status = $this->input->post('status'); // 1 e paguar , 0 - pa paguar
			$iznos = 0;

			if ($status == 'on'){
				$status = 1;
			}else{
				$status = 0;
			}
			

			$max_id_vlez = $this->vl_fakturi_model->sel_max_id_vl() + 1;
			for($i = 1 ; $i<=$br_artikli; $i++){
				
				$sifra_artikal = $this->input->post("prod_FH_".$i);
				$nabavna_so_ddv = $this->input->post("nabavna_so_ddv_FH_".$i);
				$nabavna_bez_ddv = $this->input->post("nabavna_bez_ddv_FH_".$i);
				$ddv = $this->input->post("ddv_FH_".$i);
				$rabat = $this->input->post("rabat_FH_".$i);
				$kolicina = $this->input->post("sasia_FH_".$i);
				$marza = $this->input->post("marza_FH_".$i);
				$prodazna_bez_ddv = $this->input->post("prodazna_bez_ddv_FH_".$i);
				$prodazna_so_ddv = $this->input->post("prodazna_so_ddv_FH_".$i);
				// DEBUGGING
				// echo 	"br_vl_faktura : " . 	$br_vl_faktura . "<br>" .
				// 		"sifra_artikal : " .	$sifra_artikal . "<br>" .
				// 		"nabavna_bez_ddv : " .  $nabavna_bez_ddv . "<br>".
				// 		"ddv : " .    			$ddv . "<br>".
				// 		"nabavna_so_ddv : " .   $nabavna_so_ddv . "<br>".
				// 		"rabat : " .    		$rabat . "<br>".
				// 		"kolicina : " .    		$kolicina . "<br>".
				// 		"marza : " .    		$marza . "<br>".
				// 		"prodazna_bez_ddv : " . $prodazna_bez_ddv . "<br>".
				// 		"prodazna_so_ddv : " .  $prodazna_so_ddv . "<br>".
				// 		"max_id_vlez : " .    	$max_id_vlez  . "<br>";
				// exit();
				// + && $marza != '' && $prodazna_bez_ddv != '' && $prodazna_so_ddv != ''
				if ($sifra_artikal != '' && $ddv != '' && $kolicina != '' && $nabavna_so_ddv != '' && $nabavna_bez_ddv != '' && $rabat != '' && $kolicina != ''){
					$iznos += $nabavna_so_ddv * $kolicina;
					$reden_broj = $i;
					//$this->vlezovi_model->ins_vlezovi($max_id_vlez,$fakture_data,$tip_dokument,$fakture_nr,$sasia_FH,$cmimi_FH,$iznos,$potroseno,$fakture_nga,$reden_broj);				
					
					// ins vo vl_fakturi_clenovi
					$this->vl_fakturi_model->ins_vl_fakturi_clenovi($br_vl_faktura,
																	$sifra_artikal,
																	$nabavna_bez_ddv,
																	$ddv,
																	$nabavna_so_ddv,
																	$rabat,
																	$kolicina,
																	//$marza,
																	//$prodazna_bez_ddv,
																	//$prodazna_so_ddv,
																	$max_id_vlez,
																	$reden_broj
																	);
					// upd zaliha / dodavaj
					$this->zaliha_model->upd_add_zaliha($sifra_artikal,$kolicina);
				}
			}
			// ins vo vl_fakturi_hd
			$this->vl_fakturi_model->ins_vl_fakturi_hd($br_vl_faktura,$iznos,$datum,$id_komintent,$status,$max_id_vlez);
			// $data['print_kalkulacija'] =  "faktura"; // per print_js
			// $this->load->view('kalkulacija_view',$data);
		}


		

		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');
		
		$this->load->model('artikli_model');
		$this->load->model('komintenti_model');
		$data['artikli'] =  $this->artikli_model->sel_artikli();
		$data['komintenti'] =  $this->komintenti_model->sel_komintenti();

		$this->load->view('magazin_view',$data); 
		
		$this->load->view('common/js_includes');
		$this->load->view('common/magazin_js');

		// if(isset($_POST['shto_FH'])){
		// 	$this->load->view('common/print_js');
		// }
		
	}
}

