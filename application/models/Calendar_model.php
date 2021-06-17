<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {

	public function __construct()	{
		parent::__construct();
		$this->load->database();
	}

	// insert
	public function insert() {
		// date type check
		if($_POST['date_type'] == "datetime-local") {
			if($_POST['sdate'] == $_POST['edate']) {
				$_POST['edate'] = date("Y-m-d\TH:i", strtotime("+1 minutes", strtotime($_POST['edate'])));
			}
		}

		$data = array(
			'm_idx' => $_POST['m_idx'],
			'sdate' => $_POST['sdate'],
			'edate' => $_POST['edate'],
			'date' => date("Y-m-d H:i:s"),
			'title' => $_POST['title'],
			'memo' => $_POST['memo'],
			'date_type' => $_POST['date_type'],
			'color' => $_POST['color']
		);

		$result = $this->db->insert("calendar", $data);

		if($result == true) {
			return "success";
		}else{
			return "fail";
		}
	}

	// update
	public function update() {
		// date type check
		if($_POST['date_type'] == "datetime-local") {
			if($_POST['sdate'] == $_POST['edate']) {
				$_POST['edate'] = date("Y-m-d\TH:i", strtotime("+1 minutes", strtotime($_POST['edate'])));
			}
		}

		$idx = $_POST['idx'];
		$data = array(
			'm_idx' => $_POST['m_idx'],
			'sdate' => $_POST['sdate'],
			'edate' => $_POST['edate'],
			'date' => date("Y-m-d H:i:s"),
			'title' => $_POST['title'],
			'memo' => $_POST['memo'],
			'date_type' => $_POST['date_type'],
			'color' => $_POST['color']
		);

		$result = $this->db->update('calendar', $data, "idx = ".$idx);

		if($result == true) {
			return "success";
		}else{
			return "fail";
		}
	}

}