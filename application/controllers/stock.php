<?php if (!defined('BASEPATH')) die();
class Stock extends Main_Controller {
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
                WHERE m.`status` = "a" AND p.`status` = "a"';
        $data_flds = array('name','model_number','price','imei_number');//,"<a href='".base_url()."users/addCustomer/{%id%}' id='{%id%}'>Edit</a>"
	echo $this->stock_model->display_grid($_POST,$sql,$data_flds);
    }

    public function getStockOverview()
    {
        /*$sql = 'SELECT m.name, m.model_number, m.price, count(p.imei_number) as total_pieces
                FROM products p
                INNER JOIN models m ON m.id = p.models_id
                WHERE m.`status` = "a" AND p.`status` = "a"
                group by m.id';*/
        $sql = 'SELECT m.id, m.name, m.model_number, m.price, COUNT(p.imei_number) AS total_pieces
                FROM models m
                LEFT JOIN products p ON m.id = p.models_id
                WHERE m.`status` = "a" and p.status = "a"
                GROUP BY m.id';
        $data_flds = array('name','model_number','price','total_pieces');
        echo $this->stock_model->display_grid($_POST,$sql,$data_flds);
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
}