<?php if (!defined('BASEPATH')) die();
class Reports extends Main_Controller {
    
	function __construct() {
        parent::__construct();
		$this->load->library('excel_generation_lib');
    }
	
	public function index() {
		 $header_data['active_tab'] = 'reports';
        $header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
		$data['cutomers'] = $this->reports_model->getCustomers();
        $this->load->view('reports/index',$data);
	}
	
	public function getCustomresInvData() {
		
		$this->reports_model->getCustomresInvData(true);
	}
	
	public function generateExcel()
	{
		$return_data = $this->reports_model->getCustomresInvData(false);
		//print_r($_POST); die;
		$data['headers'] = array('Invoice Number','Name','Address','Total Sale Aamount(Rs)','Discount(Rs.)','Amount after Discount(Rs)','VAT','Total Amount(Rs)','Total Amount Paid(Rs)','Balance Amount(Rs)','Invoice Date');
		$data['values'] = $return_data;
		
		//echo '<pre>'; print_r($data); die;
		 $filename = $this->excel_generation_lib->excel_generation($data);
		//die;
		$this->download($filename);
		
	}
	public function download($filename) {
        //$filename = $filename;
        $data = file_get_contents("downloads/".$filename); // Read the file's contents
        force_download($filename, $data);
    }	

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