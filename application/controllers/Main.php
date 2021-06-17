<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct()	{
		parent::__construct();
		$this->load->model('main_model');
	}

	public function index()	{
		$data = array();
		
		$data['title'] = "Main";

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
