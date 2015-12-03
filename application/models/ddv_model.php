<?php
class Ddv_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function sel_ddv($sifra_artikal){
		$sel_ddv = $this->db->query("
			select 
				ddv
			from
				artikli
			where sifra_artikal = $sifra_artikal
		");
		return $sel_ddv->row()->ddv;
	}
}