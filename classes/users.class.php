<?php

class Users extends DBHelper {

	public $krdb = '';

	function __construct($bdb){
		parent::__construct($bdb);
	}

	function login_process($params){
		$user_id = '';
		$sql = "SELECT id FROM users 
	        WHERE username = '{$params['username']}'
	        	AND password = '{$params['password']}'
	        ";
	    foreach ($this->krdb->query($sql) as $row) { 
	         $user_id = $row['id'];     
	    }
	    return $user_id;
	}

	function create_user($params){
		$insert_params = [];
		$insert_params['table'] = 'users';
		$insert_params['executes'] = $params;
		return $this->insert_into($insert_params);
	}

	public function salt_pass($password){
		$pre_salt = md5($password);
		$salted = md5($pre_salt.$salt);
		$i=0;
		while($i < 25){
			$salted = md5($salted.$salt);
			$i++;
		}
		return $salted;
	}

}
