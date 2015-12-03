<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_ditor_controller extends CI_Controller {

	public function index()
	{
		$print = 0;
		$this->load->model('dbselect');

		if (isset($_POST['kontrollo_kontroll_ditor'])){
			$date = $this->input->post('datepicker');
			$time_from = $this->input->post('timepickerFrom');
			$time_to = $this->input->post('timepickerTo');

			$data['report_ditor'] = $this->dbselect->get_reportDitor($date,$time_from,$time_to);

			$data['date'] = $date;
			$data['time_from'] = $time_from;
			$data['time_to'] = $time_to;
			
		}else{
			$data['empty'] =  ''; // if this is not written, will ask for data :/
		}
		if (isset($_POST['report_ditor_print'])){  // print
			$date = $this->input->post('datepicker');
			$time_from = $this->input->post('timepickerFrom');
			$time_to = $this->input->post('timepickerTo');

			$data['date'] = $date;
			$data['time_from'] = $time_from;
			$data['time_to'] = $time_to;
			
			$data['report_ditor'] = $this->dbselect->get_reportDitor($date,$time_from,$time_to);
			$data['print_report_ditor'] = 'print';

			$print = 1;
		}

		$this->load->model('dbselect');
		$this->load->view('common/css_includes');
		$this->load->view('common/header_html');
		
		if($print == 1){
			$this->load->view("print_report_ditor.php",$data);
		}

		$this->load->view("report_ditor_view.php",$data);
		$this->load->view('common/js_includes');
		$this->load->view('common/print_js');
	}
}