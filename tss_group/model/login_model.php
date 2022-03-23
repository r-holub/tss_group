<?php

class Login_model extends Model {
	
	public function login($name, $pass) {
		$user_id = $this->db->query("SELECT user_id FROM users WHERE name = '". $this->db->escape($name) ."' AND password = '". $this->db->escape($pass) ."' LIMIT 1")->row;
		
		if (isset($user_id['user_id']) && $user_id['user_id']) {
			return $user_id['user_id'];
		}
		
		return 0;
	}
	
}