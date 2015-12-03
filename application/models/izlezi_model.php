<?php
class Izlezi_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function ins_izlezi($id_izlez,$sifra_artikal,$datum,$tip_dokument,$sifra_dokument,$kolicina,$cena,$id_komintent){
		$this->db->query("
			insert into izlezi 
				(
					id_izlez,
					art_sifra_artikal,
					datum,
					tip_dokument,
					sifra_dokument,
					kolicina,
					cena,
					komintenti_id_komintent
				)
			values
				(
					$id_izlez,
					$sifra_artikal,
					'$datum',
					$tip_dokument,
					$sifra_dokument,
					$kolicina,
					$cena,
					$id_komintent
				)
		");
	}

	function sel_maxId_izlez(){
		$max_id_izlez = $this->db->query("
			select 
				ifnull(max(id_izlez),0) max_id_izlez
			from
				izlezi
		");
		return $max_id_izlez->row()->max_id_izlez;
	}

	// JSON TO DATATABLES
	function sel_iz_fakturi_hd_JSON(){
		$data = array();
		$query_vl_fakturi = $this->db->query("
			select
				broj_faktura,
				komintenti.ime_komintent,
				fakturi_hd.datum,
				iznos,
				id_komintent
			from 
				fakturi_hd
			inner join komintenti
				on fakturi_hd.komintenti_id_komintent = komintenti.id_komintent
		");
		foreach($query_vl_fakturi->result() as $fieldname => $fieldvalue) {
    		$data[$fieldname] = $fieldvalue;
    	}
    	$this->output->set_content_type('application/json')->
    		set_output("{\"data\":" . json_encode($data) . "}");
	}

	function sel_iz_fakturi_clenovi_JSON($broj_faktura){
		$data = array();
		$query_vl_fakturi_clenovi = $this->db->query("
			select
				naziv_artikal,
				cena,
				kolicina
			from 
				fakturi_clenovi
			inner join artikli
				on fakturi_clenovi.artikli_sifra_artikal = artikli.sifra_artikal
			where hd_fakt_broj = $broj_faktura
		");
		foreach($query_vl_fakturi_clenovi->result() as $fieldname => $fieldvalue) {
    		$data[$fieldname] = $fieldvalue;
    	}
    	$this->output->set_content_type('application/json')->
    		set_output(json_encode($data));
	}
}