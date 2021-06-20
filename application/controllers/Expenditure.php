<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenditure extends CI_Controller {
	
	public function __construct()	{
		parent::__construct();
		$this->load->model('expenditure_model');
		$this->load->model('ajax_model');
	}

	public function index() {
		$expenditure_type = $this->expenditure_model->expenditure_type();

		$data = array();
		$data['title'] = "SO | 내 지출";
		$data['expenditure_type'] = $expenditure_type;

		$this->load->view('include/header', $data);
		$this->load->view('expenditure/index');
		$this->load->view('include/footer');
	}

	// insert
	public function insert() {
		$result = $this->expenditure_model->insert();

		redirect('/expenditure');
	}

	// 전체 지출
	public function get_expenditure() {
		$data = array();

		$result = $this->ajax_model->expenditure_get_expenditure();

		foreach($result as $key => $value) {
			// 수입, 지출 구분
			if($value['income_expenditure'] == "expenditure") {
				$amount = "-".$value['amount'];
			}else if($value['income_expenditure'] == "income") {
				$amount = "+".$value['amount'];
			}


			array_push($data, array('title' => $amount, 'start' => $value['date'], 'idx' => $value['idx']));
		}

		echo json_encode($data);
	}

	// get_one_expenditure
	public function get_one_expenditure() {
		$data = array();

		$result = $this->ajax_model->expenditure_get_one_expenditure();

		foreach($result as $key => $value) {
			array_push($data, array('amount' => $value['amount'], 'date' => $value['date'], 'idx' => $value['idx'], 'method' => $value['method'], 'et_idx' => $value['et_idx'], 'income_expenditure' => $value['income_expenditure'], 'm_idx' => $value['m_idx']));
		}

		echo json_encode($data);
	}

	// update
	public function update() {
		$result = $this->expenditure_model->update();

		if($result == "success") {
			redirect('/expenditure');
		}
	}

	// get_chart_expenditure
	public function get_chart_expenditure() {
		$data = array();

		$result = $this->ajax_model->expenditure_get_chart_expenditure();

		foreach($result as $key => $value) {
			array_push($data, array('amount' => $value['amount'], 'name' => $value['name']));
		}

		echo json_encode($data);
	}

	// get_list_expenditure
	public function get_list_expenditure() {
		$data = array();

		$result = $this->ajax_model->expenditure_get_list_expenditure();

		echo json_encode($result);
	}
}