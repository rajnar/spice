<?php if (!defined('BASEPATH')) die();
class Stock extends Main_Controller {

	function __construct() {
        parent::__construct();
        $this->load->library('excel_generation_lib');
    }
    public function index() {
        $header_data['active_tab'] = 'stock';
		$header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        //$data['stock_overview'] = $this->stock_model->stockOverview();
        $data['models'] = $this->models_model->getModels();
        $this->load->view('stock/index',$data);
    }

    public function getStock()
    {
        $sql = 'SELECT m.name, m.model_number, m.price, p.id, p.imei_number
                FROM products p
                INNER JOIN models m ON m.id = p.models_id
                WHERE m.`status` = "a" AND p.`status` in ("a","c")';
        $data_flds = array('model_number','name','price','imei_number');//,"<a href='".base_url()."users/addCustomer/{%id%}' id='{%id%}'>Edit</a>"
	echo $this->stock_model->display_grid($_POST,$sql,$data_flds);
    }

    public function getStockOverview($from_grid=true)
    {
		$this->stock_model->getStockOverview(true);
    }

    public function add_stock()
    {
        $header_data['active_tab'] = 'stock';
		$header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        //$data['stock_overview'] = $this->stock_model->stockOverview();
        $data['models'] = $this->models_model->getModels();
        $this->load->view('stock/add_stock',$data);
    }

    public function saveStock()
    {
       $ret_array = $this->stock_model->saveStock();
       echo json_encode($ret_array);
    }

    public function getStockDetails()
    {
        /*echo '<pre>';
        print_r($_POST);die;*/
        $data['details'] = $this->stock_model->getStockDetails($_POST);
        $data['customers'] = $this->customers_model->getCustomers();
        
        $data['invoice_details']['details_rs'] = tableEmptyValues('sales');
        $data['invoice_details']['details_rs']->amount_paid = '';
        //print_r($data['invoice_details']);die;
        $html = $this->load->view('sales/sale_details',$data,true);
        echo $html;
        //print_r($details);
    }

    public function return_stock()
    {
        $header_data['active_tab'] = 'return_stock';
		$header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        //$data['stock_overview'] = $this->stock_model->stockOverview();
        //$data['models'] = $this->models_model->getModels();
        $this->load->view('stock/return_stock',$data);
    }

    public function returnStockSave()
    {
        $this->stock_model->returnStockSave($_POST);
    }
	public function generateExcel() {
        $return_data = $this->stock_model->getStockOverview(false);
        //print_r($_POST); die;
        $data['date_range'] = $_POST;
        $data['headers'] = array('Model Number','Model Name','Price','Current Available Stock');
        $data['values'] = $return_data;
        if(!empty($return_data)) {
        //echo '<pre>'; print_r($data); die;
            $filename = $this->excel_generation_lib->stock_generation($data);
            //die;
            //$this->download($filename);
            echo json_encode(array('error_code'=>200,'error_msg'=>'Success','filename'=>$filename));
        }
        else {
            echo json_encode(array('error_code'=>301,'error_msg'=>'No Data Available'));
        }

    }
}