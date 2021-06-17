<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {

	public function __construct()	{
		parent::__construct();
		$this->load->database();
	}

	// calendar_get_events
	public function calendar_get_events() {
		$result = $this->db->query("select * from calendar")->result_array();

		return $result;
	}

	// calendar_get_one_event
	public function calendar_get_one_event() {
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		$result = $this->db->query("select * from calendar where idx = ".$decoded['idx']."")->result_array();

		return $result;
	}	

	// expenditure_get_expenditure
	public function expenditure_get_expenditure() {
		if(!isset($_COOKIE['m_idx'])) {
			$_COOKIE['m_idx'] = 0;
		}

		$result = $this->db->query("select * from expenditure_history where m_idx = ".$_COOKIE['m_idx']."")->result_array();

		return $result;
	}

	// expenditure_get_one_expenditure
	public function expenditure_get_one_expenditure() {
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		$result = $this->db->query("select * from expenditure_history where idx = '".$decoded['idx']."'")->result_array();

		return $result;
	}

	// expenditure_get_chart_expenditure
	public function expenditure_get_chart_expenditure() {
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		$result = $this->db->query("select eh.idx, eh.m_idx, eh.income_expenditure, eh.method, eh.et_idx, sum(eh.amount) amount, eh.date, et.name from expenditure_history eh left join expenditure_type et on eh.et_idx = et.idx where eh.m_idx = ".$decoded['m_idx']." and eh.date like '".$decoded['date']."%' and eh.income_expenditure = 'expenditure' group by eh.et_idx;")->result_array();

		return $result;
	}

	// expenditure_get_list_expenditure
	public function expenditure_get_list_expenditure() {
		$data = array('expenditure' => array(), 'income' => array());

		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		$result = $this->db->query("select eh.idx, eh.m_idx, eh.income_expenditure, eh.method, eh.et_idx, sum(eh.amount) amount, eh.date, et.name from expenditure_history eh left join expenditure_type et on eh.et_idx = et.idx where eh.m_idx = ".$decoded['m_idx']." and eh.date like '".$decoded['date']."%' and eh.income_expenditure = 'expenditure' group by eh.et_idx;")->result_array();
		for($i = 0; $i < count($result); $i++) {
			array_push($data['expenditure'], $result[$i]);
		}

		$result = $this->db->query("select eh.idx, eh.m_idx, eh.income_expenditure, eh.method, eh.et_idx, sum(eh.amount) amount, eh.date, et.name from expenditure_history eh left join expenditure_type et on eh.et_idx = et.idx where eh.m_idx = ".$decoded['m_idx']." and eh.date like '".$decoded['date']."%' and eh.income_expenditure = 'income' group by eh.et_idx;")->result_array();
		for($i = 0; $i < count($result); $i++) {
			array_push($data['income'], $result[$i]);
		}

		return $data;
	}
}