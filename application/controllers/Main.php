<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct()	{
		parent::__construct();
		$this->load->model('main_model');
	}

	public function index()	{
		$data = array();
		
		// 방문자 카운트
		$result = $this->main_model->get_count_visit();
		$data['total'] = $result['total'];
		$data['today'] = $result['today'];
		
		$data['title'] = "SO | 일정과 지출을 관리해 보세요";
		
		$this->load->view('include/header', $data);
		$this->load->view('main/index');
		$this->load->view('include/footer');
	}

	// 로그인/회원가입
	public function login() {
		$result = $this->main_model->login();

		if($result == "success") {
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// 로그아웃
	public function logout() {
		$result = $this->main_model->logout();
		
		if($result == "success") {
			redirect('/main');
		}
	}
}
