<?php
class Vlezovi_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	// JSON TO DATATABLES
	// function sel_vlezoviJSON(){
	// 	$data = array();
	// 	$query = $this->db->query("
	// 		select
	// 			id_vlez,
	// 			ime_komintent,
	// 			tip_dokument,
	// 			sifra_dokument,
	// 			naziv_artikal,
	// 			sifra_artikal,
	// 			kolicina,
	// 			cena,
	// 			vlezovi.ddv,
	// 			vlezovi.iznos,
	// 			STR_TO_DATE(vlezovi.datum,%d/%m/%Y'),
	// 			sum(iznos) totali
	// 		from 
	// 			vlezovi
	// 		inner join komintenti
	// 			on vlezovi.komintenti_id_komintent = komintenti.id_komintent
	// 		inner join artikli
	// 			on vlezovi.artikli_sifra_artikal = artikli.sifra_artikal
	// 		group by id_vlez

	// 	");
	// 	foreach($query->result() as $fieldname => $fieldvalue) {
 //    		$data[$fieldname] = $fieldvalue;
 //    	}
 //    	$this->output->set_content_type('application/json')->
 //    		set_output("{\"data\":" . json_encode($data) . "}");
	// }

	function sel_vlezovi_fifo($sifra_artikal){
		$vlezovi_fifo_query = $this->db->query("
			select
				id_vlez,
				potroseno,
				kolicina
			from
				vlezovi
			where
				artikli_sifra_artikal = $sifra_artikal
				and potroseno < kolicina
			order by datum
		");
		return $vlezovi_fifo_query->result();
	}


	function ins_vlezovi($id_vlez,$datum,$tip_dokument,$sifra_dokument,$kolicina,$cena,$iznos,$potroseno,$id_komintent,$reden_broj){
		$new_date = date('Y-m-d', strtotime(str_replace('/', '-',$datum)));
		
		$this->db->query("
			insert into vlezovi 
				(
					id_vlez,
					datum,
					tip_dokument,
					sifra_dokument,
					kolicina,
					cena,
					iznos,
					potroseno,
					komintenti_id_komintent,
					reden_broj
				)
			values
				(
					$id_vlez,
					'$new_date',
					$tip_dokument,
					$sifra_dokument,
					$kolicina,
					$cena,
					$iznos,
					$potroseno,
					$id_komintent,
					$reden_broj
				)
		");
	}

	function sel_maxId_vlez(){
		$max_id_vlez = $this->db->query("
			select 
				ifnull(max(id_vlez),0) max_id_vlez
			from
				vlezovi
			where 
				year(datum) = year(sysdate())
		");
		return $max_id_vlez->row()->max_id_vlez;
	}

	function sel_maxFaktura_br(){
		$max_fakt_br = $this->db->query("
			select 
				ifnull(max(sifra_dokument),0) max_fakt_br
			from
				vlezovi
			where 
				year(datum) = year(sysdate())
				and tip_dokument = 1
		");
		return $max_fakt_br->row()->max_fakt_br;
	}
	

	// update potroseno
	function upd_vlezovi_potroseno($id_vlez,$kolicina){
		$this->db->query("
			update 
				vlezovi
			set
				potroseno = potroseno + $kolicina
			where 
				id_vlez = $id_vlez

		");
	}

	

}