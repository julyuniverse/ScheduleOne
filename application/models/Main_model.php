<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

	public function __construct()	{
		parent::__construct();
		$this->load->database();
	}

	// 로그인/회원가입
	public function login() {
		$result = $this->db->query("select count(*) cnt from member where id = '".$this->input->post("id")."'")->result_array();

		if($result[0]['cnt'] < 1) {
			$data = array(
				'id' => $this->input->post("id"),
				'join_date' => date("Y-m-d H:i:s")
			);
			$this->db->insert('member', $data);
		}
		
		$result = $this->db->query("select * from member where id = '".$this->input->post("id")."'")->result_array();
		$m_idx = $result[0]['idx'];

		setcookie("m_idx", $m_idx, time()+3600, "/");
		return "success";
	}

	// 로그아웃
	public function logout() {
		setcookie("m_idx", "", 0, "/");
		return "success";
	}
}