<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
	
	public function __construct()	{
		parent::__construct();
		$this->load->model('calendar_model');
		$this->load->model('ajax_model');
	}

	public function index() {
		$data = array();
		
		$data['title'] = "내 달력";

		$this->load->view('include/header', $data);
		$this->load->view('calendar/index');
		$this->load->view('include/footer');
	}

	// 전체 일정
	public function get_events() {
		$data = array();

		$result = $this->ajax_model->calendar_get_events();

		foreach($result as $key => $value) {
			// date type check
			if($value['date_type'] === "datetime-local") {
				$edate = $value['edate'];
			}else if($value['date_type'] === "date"){
				$edate = date("Y-m-d", strtotime("+1 day", strtotime($value['edate'])));
			}
			array_push($data, array('title' => $value['title'], 'start' => $value['sdate'], 'end' => $edate, 'idx' => $value['idx'], 'color' => $value['color'], 'memo' => $value['memo']));
		}

		echo json_encode($data);
	}

	// 하나의 일정
	public function get_one_event() {
		$data = array();
		
		$result = $this->ajax_model->calendar_get_one_event();

		foreach($result as $key => $value) {
			array_push($data, array('title' => $value['title'], 'start' => $value['sdate'], 'end' => $value['edate'], 'idx' => $value['idx'], 'memo' => $value['memo'], 'date_type' => $value['date_type'], 'color' => $value['color'], 'm_idx' => $value['m_idx']));
		}

		echo json_encode($data);

	}

	// insert
	public function insert() {
		$result = $this->calendar_model->insert();

		if($result == "success") {
			redirect('/calendar');
		}
	}

	// update
	public function update() {
		$result = $this->calendar_model->update();

		if($result == "success") {
			redirect('/calendar');
		}
	}
	
	
}