<?php
class Komintenti_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function sel_komintenti(){
		$sel_komintenti = $this->db->query("
			select 
				id_komintent,
				ime_komintent,
				telefon,
				adresa,
				ime_grad
			from
				komintenti
			left join gradovi
				on gradovi.id_grad = komintenti.gradovi_id_grad
		");
		return $sel_komintenti->result();
	}

	function ins_komintenti($ime_komintent,$tel_komintent,$id_grad,$datum){
		if ($tel_komintent == '' || !isset($tel_komintent)){
			$tel_komintent = 'NULL';
		}
		$this->db->query("
			insert into komintenti 
				(
					ime_komintent,
					telefon,
					datum,
					gradovi_id_grad
				)
			values
				(
					'$ime_komintent',
					$tel_komintent,
					'$datum',
					$id_grad
				)
		");
	}
	// SAMO ZA EDEN KOMMINTENT
	function sel_komintent_detail($id_komintent){
		$sel_komintent_detail = $this->db->query("
			select 
				ime_komintent,
				telefon,
				adresa,
				ime_grad
			from
				komintenti
			left join gradovi
				on gradovi.id_grad = komintenti.gradovi_id_grad
			where
				komintenti.id_komintent = $id_komintent
		");
		return $sel_komintent_detail->result();
	}
}