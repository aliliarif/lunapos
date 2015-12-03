<?php
class Artikli_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function ins_artikli($sifra_artikal,$naziv_artikal,$nabavna_cena_so_ddv,$nabavna_cena_bez_ddv,$prodazna_cena,$ddv,$marza,$ed_merka,$zaliha,$datum,$interna_sifra,$kolicina_pak){
		$this->db->query("
			insert into artikli 
				(
					sifra_artikal,
					naziv_artikal,
					nabavna_cena_so_ddv,
					nabavna_cena_bez_ddv,
					prodazna_cena,
					ddv,
					marza,
					ed_merka,
					zaliha,
					datum,
					interna_sifra,
					kolicina_pak
				)
			values
				(
					$sifra_artikal,
					'$naziv_artikal',
					$nabavna_cena_so_ddv,
					$nabavna_cena_bez_ddv,
					$prodazna_cena,
					$ddv,
					$marza,
					'$ed_merka',
					$zaliha,
					'$datum',
					$interna_sifra,
					$kolicina_pak
				)
		");
	}

	function sel_artikli(){
		$sel_artikli = $this->db->query("
			select 
				sifra_artikal,
				naziv_artikal,
				prodazna_cena,
				ddv,
				zaliha,
				ed_merka,
				prodadeni,
				interna_sifra,
				kolicina_pak,
				marza,
				nabavna_cena_bez_ddv,
				nabavna_cena_so_ddv,
				static_zaliha
			from
				artikli
		");
		return $sel_artikli->result();
	}

	function sel_maxSifra_artikal(){
		$sel_sifra = $this->db->query("
			select
				ifnull(max(sifra_artikal),0) max_sifra_artikal
			from 
				artikli
		");
		return $sel_sifra->row()->max_sifra_artikal;
	}

	function sel_naziv_artikal($sifra_artikal){
		$sel_naziv = $this->db->query("
			select
				naziv_artikal
			from 
				artikli
			where 
				sifra_artikal = $sifra_artikal
		");
		return $sel_naziv->row()->naziv_artikal;
	}

	function upd_artikal($sifra_artikal,$naziv_artikal,$nabavna_cena_so_ddv,$nabavna_cena_bez_ddv,$ddv,$marza,$ed_merka,$interna_sifra,$kolicina_pak,$prodazna_cena,$cena){
		$this->db->query("
			update 
				artikli
			set
				naziv_artikal = '$naziv_artikal',
				nabavna_cena_so_ddv = $nabavna_cena_so_ddv,
				nabavna_cena_bez_ddv = $nabavna_cena_bez_ddv,
				ddv = $ddv,
				marza = $marza,
				ed_merka = '$ed_merka',
				interna_sifra = $interna_sifra,
				kolicina_pak = $kolicina_pak,
				prodazna_cena = $prodazna_cena
			where 
				sifra_artikal = $sifra_artikal
		");
	}
}