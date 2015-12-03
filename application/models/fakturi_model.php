<?php
class Fakturi_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function ins_fakturi_hd($broj_faktura,$iznos,$datum,$id_komintent,$smetki_hd_broj){
		$this->db->query("
			insert into fakturi_hd 
				(
					broj_faktura,
					iznos,
					datum,
					komintenti_id_komintent,
					smetki_hd_broj
				)
			values
				(
					$broj_faktura,
					$iznos,
					'$datum',
					$id_komintent,
					$smetki_hd_broj
				)
		");
	}

	function ins_fakturi_clenovi($hd_fakt_broj,$sifra_artikal,$cena,$ddv_vrednost,$popust,$kolicina,$reden_broj){
		$this->db->query("
			insert into fakturi_clenovi
				(
					hd_fakt_broj,
					artikli_sifra_artikal,
					cena,
					ddv_vrednost,
					popust,
					kolicina,
					reden_broj
				)
			values
				(
					$hd_fakt_broj,
					$sifra_artikal,
					$cena,
					$ddv_vrednost,
					$popust,
					$kolicina,
					$reden_broj
				)
		");
	}

	function sel_maxBroj_fakt($datum){
		$max_broj_fakt = $this->db->query("
			select 
				ifnull(max(broj_faktura),0) max_broj_faktura
			from
				fakturi_hd
			where
				year(datum) = year('$datum')
		");
		return $max_broj_fakt->row()->max_broj_faktura;
	}

	function sel_faktura($broj_faktura,$datum){
		// cena meret prejt te fakturi_clenovi se mund ta ndryshoje gjat shitjes...
		$faktura = $this->db->query("
			select
				artikli.naziv_artikal,
				artikli.ddv,
				artikli.ed_merka,
				artikli.kolicina_pak,
				fakturi_hd.iznos,
				fakturi_clenovi.cena,
				fakturi_clenovi.kolicina,
				fakturi_clenovi.popust
			from 
				artikli
			inner join fakturi_clenovi
				on fakturi_clenovi.artikli_sifra_artikal = artikli.sifra_artikal
			inner join fakturi_hd
				on fakturi_hd.broj_faktura = fakturi_clenovi.hd_fakt_broj
			 
			where 
				fakturi_hd.broj_faktura = $broj_faktura
				and fakturi_hd.datum = '$datum'
		");
		return $faktura->result();
	}
}