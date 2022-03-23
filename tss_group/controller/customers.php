<?php

class Customers extends Controller {
	
	private $json;
	
	public function index() {
		$data['title'] = 'Edit customers';
		
		$data['customers'] = $this->model->getCustomers();
		$data['categories'] = $this->model->getCategories();
		
		$this->view('part/header', $data);
		$this->view('customers', $data);
		$this->view('part/footer', $data);
	}
	
	public function edit() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = $_POST;
			
			$data['customer_id'] = isset($data['customer_id']) ? (int)$data['customer_id'] : 0;
			$data['number'] = isset($data['number']) ? trim(strip_tags($data['number'])) : '';
			$data['name'] = isset($data['name']) ? trim(strip_tags($data['name'])) : '';
			$data['last_name'] = isset($data['last_name']) ? trim(strip_tags($data['last_name'])) : '';
			$data['category_id'] = isset($data['category_id']) ? (int)$data['category_id'] : 0;
			
			if ($this->validate($data)) {
				if ($this->model->editCustomer($data)) {
					$this->json['success'] = 'success!';
				} else {
					$this->json['error'] = 'unknown error';
				}
			}
		}
		
		header("Content-Type: application/json");
		echo json_encode($this->json);
		exit();
	}
	
	public function validate($data) {
		
		$categories = $this->model->getCategories();
		$category_ids = array();
		foreach ($categories as $category) {
			$category_ids[] = $category['category_id'];
		}
		
		if (!$data['customer_id'] || ((int)$data['customer_id'] <= 0)) {
			$this->json['error'] = 'customer_id required!';
			return 0;
		}
		
		if (!$data['number']) {
			$this->json['error'] = 'number required!';
			return 0;
		}
		
		if (!$data['name']) {
			$this->json['error'] = 'name required!';
			return 0;
		}
		
		if (!$data['last_name']) {
			$this->json['error'] = 'name required!';
			return 0;
		}
		
		if (!in_array((int)$data['category_id'], $category_ids)) {
			$this->json['error'] = 'category_id required!';
			return 0;
		}
		
		return 1;
	}
}