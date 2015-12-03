<?php
class Smetki_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	// plus popust ako saakame za cela smetka? $popust
	function ins_smetki_hd($broj_smtk,$tip_plakanje,$iznos,$datum,$id_komintent){
		$this->db->query("
			insert into smetki_hd 
				(
					broj_smtk,
					tip_plakanje,
					iznos,
					datum,
					komintenti_id_komintent
				)
			values
				(
					$broj_smtk,
					$tip_plakanje,
					$iznos,
					'$datum',
					$id_komintent
				)
		");
	}

	function ins_smetki_clenovi($broj_smtk,$sifra_artikal,$cena,$ddv_vrednost,$popust,$kolicina,$reden_broj){
		$this->db->query("
			insert into smetki_clenovi
				(
					hd_broj_smtk,
					artikli_sifra_artikal,
					cena,
					ddv_vrednost,
					popust,
					kolicina,
					reden_broj
				)
			values
				(
					$broj_smtk,
					$sifra_artikal,
					$cena,
					$ddv_vrednost,
					$popust,
					$kolicina,
					$reden_broj
				)
		");
	}

	function sel_maxBroj_smtk($datum){
		$max_broj_smtk = $this->db->query("
			select 
				ifnull(max(broj_smtk),1) max_broj_smtk
			from
				smetki_hd
			where 
				year(datum) = year('$datum')
		");
		return $max_broj_smtk->row()->max_broj_smtk;
	}
}