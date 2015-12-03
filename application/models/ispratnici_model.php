<?php
class Ispratnici_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function ins_ispratnici_hd($broj_ispr,$iznos,$datum,$id_komintent,$smetki_hd_broj){
		$this->db->query("
			insert into ispratnici_hd 
				(
					broj_ispr,
					iznos,
					datum,
					komintenti_id_komintent,
					smetki_hd_broj
				)
			values
				(
					$broj_ispr,
					$iznos,
					'$datum',
					$id_komintent,
					$smetki_hd_broj
				)
		");
	}

	function ins_ispratnici_clenovi($broj_ispratnica,$sifra_artikal,$cena,$ddv_vrednost,$popust,$kolicina,$reden_broj){
		$this->db->query("
			insert into ispratnici_clenovi
				(
					hd_ispr_broj,
					artikli_sifra_artikal,
					cena,
					ddv_vrednost,
					popust,
					kolicina,
					reden_broj
				)
			values
				(
					$broj_ispratnica,
					$sifra_artikal,
					$cena,
					$ddv_vrednost,
					$popust,
					$kolicina,
					$reden_broj
				)
		");
	}

	function sel_maxBroj_ispr($datum){
		$max_broj_ispr = $this->db->query("
			select 
				ifnull(max(broj_ispr),0) max_broj_ispr
			from
				ispratnici_hd
			where
				year(datum) = year('$datum')
		");
		return $max_broj_ispr->row()->max_broj_ispr;
	}

	function sel_ispratnica($broj_ipsratnica,$datum){
		// cena meret prejt te fakturi_clenovi se mund ta ndryshoje gjat shitjes...
		$ispratnica = $this->db->query("
			select
				artikli.naziv_artikal,
				artikli.ddv,
				artikli.ed_merka,
				artikli.kolicina_pak,
				ispratnici_hd.iznos,
				ispratnici_clenovi.cena,
				ispratnici_clenovi.kolicina,
				ispratnici_clenovi.popust
			from 
				artikli
			inner join ispratnici_clenovi
				on ispratnici_clenovi.artikli_sifra_artikal = artikli.sifra_artikal
			inner join ispratnici_hd
				on ispratnici_hd.broj_ispr = ispratnici_clenovi.hd_ispr_broj
			where 
				ispratnici_hd.broj_ispr = $broj_ipsratnica
				and ispratnici_hd.datum = '$datum'
		");
		return $ispratnica->result();
	}
}