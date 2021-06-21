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

	// get_count_visit
	public function get_count_visit() {
		$data = array();
		// 오늘 날짜의 data가 있는지 확인한다.
		$result = $this->db->query("select count(*) cnt from visit where date = '".date("Y-m-d")."'")->result_array();
		if($result[0]['cnt'] < 1) {
			$tmpData = array(
				'date' => date("Y-m-d"),
				'count' => 1
			);

			$this->db->insert('visit', $tmpData);

			$result2 = $this->db->query("select sum(count) total from visit")->result_array();
			$data['total'] = $result2[0]['total'];
			$data['today'] = 1;

			return $data;
			exit;
		}else{
			$this->db->query("update visit set count = count+1 where date = '".date("Y-m-d")."'");

			$result2 = $this->db->query("select sum(count) total from visit")->result_array();
			$data['total'] = $result2[0]['total'];
			$result3 = $this->db->query("select count from visit where date = '".date("Y-m-d")."'")->result_array();
			$data['today'] = $result3[0]['count'];

			return $data;
			exit;
		}
	}
}