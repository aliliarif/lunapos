<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gradovi_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function sel_gradovi(){
		$sel_gradovi = $this->db->query("
			select
				*
			from
				gradovi
		");
		return $sel_gradovi->result();
	}
}

/* End of file gradovi_model.php */
/* Location: ./application/models/gradovi_model.php */