<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenditure_model extends CI_Model {

	public function __construct()	{
		parent::__construct();
		$this->load->database();
	}

	// expenditure_type
	public function expenditure_type() {
		$result = $this->db->query("select * from expenditure_type")->result_array();
		return $result;
	}

	// insert
	public function insert() {
		$data = array(
			'm_idx' => $_POST['m_idx'],
			'income_expenditure' => $_POST['income_expenditure'],
			'method' => $_POST['method'],
			'et_idx' => $_POST['type'],
			'amount' => $_POST['amount'],
			'date' => $_POST['date']
		);

		$this->db->insert('expenditure_history', $data);
	}

	// update
	public function update() {
		
		$idx = $_POST['idx'];
		$data = array(
			'income_expenditure' => $_POST['income_expenditure'],
			'method' => $_POST['method'],
			'et_idx' => $_POST['type'],
			'amount' => $_POST['amount'],
			'date' => $_POST['date']
		);

		$result = $this->db->update('expenditure_history', $data, "idx = ".$idx);

		if($result == true) {
			return "success";
		}else{
			return "fail";
		}
	}
}