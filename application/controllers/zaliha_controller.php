<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zaliha_controller extends CI_Controller {

	public function index()
	{
		// thiret nga AJAXI ne index_script.js
		$sifra_artikal = $this->input->get('sifra_artikal');

		$this->load->model('zaliha_model');
		$vo_zaliha = $this->zaliha_model->sel_zaliha($sifra_artikal);
		
		echo $vo_zaliha;
	}
}