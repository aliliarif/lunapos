<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vl_fakturi_model extends CI_Model {

	function sel_vl_fakturi_clenovi($id_vl_fakt){
		$query_vl_fakt_clenovi = $this->db->query("
			select 
				*
			from
				vl_fakturi_clenovi
			where 
				hd_id_vl_fakt = $id_vl_fakt
		");
	}

	// JSON TO DATATABLES
	function sel_vl_fakturi_hd_JSON(){
		$data = array();
		$query_vl_fakturi = $this->db->query("
			select
				broj_vl_faktura,
				ime_komintent,
				DATE_FORMAT(vl_fakturi_hd.datum,'%d/%m/%Y') datum,
				iznos,
				status,
				id_vl_fakt,
				id_komintent
			from 
				vl_fakturi_hd
			inner join komintenti
				on vl_fakturi_hd.komintenti_id_komintent = komintenti.id_komintent
		");
		foreach($query_vl_fakturi->result() as $fieldname => $fieldvalue) {
    		$data[$fieldname] = $fieldvalue;
    	}
    	$this->output->set_content_type('application/json')->
    		set_output("{\"data\":" . json_encode($data) . "}");
	}

	function sel_vl_fakturi_clenovi_JSON($id_vl_fakt){
		$data = array();
		$query_vl_fakturi_clenovi = $this->db->query("
			select
				naziv_artikal,
				cena_bez_ddv,
				vl_fakturi_clenovi.ddv,
				cena_so_ddv,
				popust,
				kolicina
			from 
				vl_fakturi_clenovi
			inner join artikli
				on vl_fakturi_clenovi.artikli_sifra_artikal = artikli.sifra_artikal
			where hd_id_vl_fakt = $id_vl_fakt
		");
		foreach($query_vl_fakturi_clenovi->result() as $fieldname => $fieldvalue) {
    		$data[$fieldname] = $fieldvalue;
    	}
    	$this->output->set_content_type('application/json')->
    		set_output(json_encode($data));
	}

	function ins_vl_fakturi_hd($broj_vl_faktura,$iznos,$datum,$id_komintent,$status,$max_id_vlez){
		$new_date = date('Y-m-d', strtotime(str_replace('/', '-',$datum)));
		$this->db->query("
			insert into vl_fakturi_hd 
				(
					broj_vl_faktura,
					iznos,
					datum,
					komintenti_id_komintent,
					status,
					id_vl_fakt
				)
			values
				(
					$broj_vl_faktura,
					$iznos,
					'$new_date',
					$id_komintent,
					$status,
					$max_id_vlez
				)
		");
	}	
	// +$marza,
	// 		$prodazna_bez_ddv,
	// 		$prodazna_so_ddv,
	function ins_vl_fakturi_clenovi(
			$hd_vl_fakt_broj,
			$sifra_artikal,
			$nabavna_bez_ddv,
			$ddv,
			$nabavna_so_ddv,
			$rabat,
			$kolicina,
			$max_id_vlez,
			$reden_broj
		){

		$this->db->query("
			insert into vl_fakturi_clenovi
				(
					hd_vl_fakt_broj,
					artikli_sifra_artikal,
					cena_bez_ddv,
					ddv,
					cena_so_ddv,
					popust,
					kolicina,
					hd_id_vl_fakt,
					reden_broj
				)
			values
				(
					$hd_vl_fakt_broj,
					$sifra_artikal,
					$nabavna_bez_ddv,
					$ddv,
					$nabavna_so_ddv,
					$rabat,
					$kolicina,
					$max_id_vlez,
					$reden_broj
				)
		");
	}

	function sel_max_id_vl(){
		$query_max_id_vl = $this->db->query("
			select 
				ifnull(max(id_vl_fakt),0) max_id_vl
			from
				vl_fakturi_hd
		");
		return $query_max_id_vl->row()->max_id_vl;
	}

	// pay faktura
	function upd_status($broj_vl_faktura,$id_komintent){
		$this->db->query("
			update 
				vl_fakturi_hd
			set 
				status = 1
			where
				broj_vl_faktura = $broj_vl_faktura
				and komintenti_id_komintent = $id_komintent
		");
	}
}

/* End of file vl_fakturi_model.php */
/* Location: ./application/models/vl_fakturi_model.php */