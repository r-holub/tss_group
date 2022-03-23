<?php

class Login extends Controller {
	public function index() {
		$data['title'] = 'Login page';
		
		$this->view('part/header', $data);
		$this->view('login', $data);
		$this->view('part/footer', $data);
	}
	
	public function submit() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = $_POST;
			
			$data['user_name'] = isset($data['user_name']) ? trim(strip_tags($data['user_name'])) : '';
			$data['user_pass'] = isset($data['user_pass']) ? trim(strip_tags($data['user_pass'])) : '';
			
			if ($this->validate($data)) {
				$user_id = $this->model->login($data['user_name'], $data['user_pass']);
				if (!$user_id) {
					echo 'Login and/or password don\'t match!';
					die();
				} else {
					$_SESSION['user_id'] = $user_id;
					
					header("HTTP/1.1 301 Moved Permanently"); 
					header("Location: /tss_group/customers"); 
					exit();
				}
			}
		}
	}
	
	public function validate($data) {
		if (!$data['user_name']) {
			echo 'Login required!';
			die();
		}
		
		if (!$data['user_pass']) {
			echo 'Password required!';
			die();
		}
		
		return 1;
	}
}