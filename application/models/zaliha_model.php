<?php
class Zaliha_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function sel_zaliha($sifra_artikal){
		$sel_zaliha_query = $this->db->query("
			select 
				zaliha
			from
				artikli
			where
				sifra_artikal = $sifra_artikal
		");
		return $sel_zaliha_query->row()->zaliha;
	}

	function upd_zaliha($sifra_artikal,$kolicina){
		$this->db->query("
			update 
				artikli
			set 
				zaliha = zaliha - $kolicina,
				prodadeni = prodadeni + $kolicina
			where 
				sifra_artikal = $sifra_artikal
		");
	}

	function upd_add_zaliha($sifra_artikal,$kolicina){
		$this->db->query("
			update 
				artikli
			set 
				static_zaliha = zaliha + $kolicina,
				zaliha = zaliha + $kolicina
			where 
				sifra_artikal = $sifra_artikal
		");

	}

}