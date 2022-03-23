<?php

class Customers_model extends Model {
	
	public function getCustomers() {
		return $this->db->query("SELECT c.customer_id, c.number, c.name, c.last_name, c.date_created, c.category_id, cat.name as category_name FROM customers c LEFT JOIN categories cat ON (c.category_id = cat.category_id) ORDER BY c.customer_id ASC")->rows;
	}
	
	public function getCategories() {
		return $this->db->query("SELECT * FROM categories")->rows;
	}
	
	public function editCustomer($data) {
		return $this->db->query("UPDATE customers SET `number` = '". $this->db->escape($data['number']) ."', `name` = '". $this->db->escape($data['name']) ."', `last_name` = '". $this->db->escape($data['last_name']) ."', `category_id` = '". (int)$data['category_id'] ."'");
	}
	
}