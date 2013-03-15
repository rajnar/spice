<?php if (!defined('BASEPATH')) die();
class Reports extends Main_Controller {
    
	function __construct() {
        parent::__construct();
		$this->load->library('excel_generation_lib');
    }
	
	public function index() {}

    public function invoiceReport()
    {
		$data['headers'] = array('Name','invoice Number','Amount');
		$data['values'] = array(
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100')
							);
		
		//echo '<pre>'; print_r($data); die;
		$this->excel_generation_lib->excel_generation($data);
	}
	public function invoicePdfReport()
    {
		$data['headers'] = array('Name','invoice Number','Amount');
		$data['values'] = array(
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100'),
							array('name'=>'abc','invoice'=>'123','amt'=>'100')
							);
		
		$filename = 'pdf_invoice';//$nmonth
		$html = $this->load->view('reports/reports_pdf', $data, true);
		//die;
		$this->load->library('pdf_generation_lib');
		if($this->pdf_generation_lib->pdf_create($html, $filename)) {
			echo $filename;
		}
		else {
			echo 'error';
		}
		
		//echo '<pre>'; print_r($data); die;
		
	}
}