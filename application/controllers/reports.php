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

    public function generateExcel() {
        $return_data = $this->reports_model->getCustomresInvData(false);
        //print_r($_POST); die;
        $data['date_range'] = $_POST;
        $data['headers'] = array('Invoice Number','Name','Address','Total Sale Aamount(Rs)','Discount(Rs.)','Amount after Discount(Rs)','Total Amount(Rs)','Total Amount Paid(Rs)','Balance Amount(Rs)','Invoice Date');
        $data['values'] = $return_data;
        if(!empty($return_data)) {
        //echo '<pre>'; print_r($data); die;
            $filename = $this->excel_generation_lib->excel_generation($data);
            //die;
            //$this->download($filename);
            echo json_encode(array('error_code'=>200,'error_msg'=>'Success','filename'=>$filename));
        }
        else {
            echo json_encode(array('error_code'=>301,'error_msg'=>'No Data Available'));
        }

    }
    public function download($file='invoice.xlsx') {

        $data = file_get_contents("downloads/".$file); // Read the file's contents
        force_download($file, $data);
        /*header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;*/
    }

    public function invoiceReport() {
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
    public function invoicePdfReport() {
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