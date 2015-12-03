<?php
class Users_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function sel_all_users(){
		$sel_users = $this->db->query("
			select 
				*
			from
				users
		");
		return $sel_users->result();
	}

	function sel_user($user,$password){
		$sel_user = $this->db->query("
			select 
				*
			from
				users
			where 
				name_user = '$user'
				and password = '$password'
		");
		return $sel_user->result();
	}

	function ins_users($name_user,$password,$admin){
		$this->db->query("
			insert into users 
				(
					name_user,
					password,
					admin
				)
			values
				(
					'$name_user',
					'$password',
					$admin
				)
		");
	}
}