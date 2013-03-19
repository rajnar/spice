<?php if (!defined('BASEPATH')) die();
class Sales extends Main_Controller {
    public function index() {
        $header_data['active_tab'] = 'sales';
        $header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('sales/index',$data);
    }

    public function getSales() {
    //$sql = 'SELECT id,invoice_number,CONCAT(first_name," ",last_name) AS name,address,city,state,zip,phone_number1,phone_number2,`status`
    //FROM customers';
        $sql = 'SELECT s.id,s.invoice_number,s.customers_id,s.total_sale_amount,s.discount,s.amount_after_discount,
                s.payment_method,s.other_details,DATE_FORMAT(s.date_added,"%d/%m/%Y %h:%i:%s %p") as date_added,
                c.id AS cusid, CONCAT(c.first_name," ",c.last_name) AS name, SUM(spd.amount) AS total_paid,
                (s.amount_after_discount- SUM(spd.amount)) AS balance
                FROM sales s
                INNER JOIN customers c ON c.id = s.customers_id
                RIGHT JOIN sales_payment_details spd ON spd.sales_id = s.id
                GROUP BY sales_id';
        $data_flds = array('invoice_number','name','total_sale_amount','discount','amount_after_discount','total_paid','balance','payment_method','date_added',"<a href='".base_url()."users/addCustomer/{%id%}' id='{%id%}'>Edit</a>");
        echo $this->sales_model->display_grid($_POST,$sql,$data_flds);
    }

    public function saveSale() {
        //print_r($_POST);die;
        $invoice_id = $this->sales_model->saveSale();
        echo $invoice_id;
    //echo json_encode(array('invoice_id'=>$invoice_id));
    }

    public function newSale() {
        $header_data['active_tab'] = 'sales';
        $header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('sales/newsale',$data);
    }

    public function return_sale() {
        $header_data['active_tab'] = 'return_sale';
        $header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('sales/return_sales',$data);
    }

    public function invoice($invoice_id) {
        $header_data['active_tab'] = 'sales';
        $header_data['user_details'] = $this->user_details;
        $data = $this->sales_model->getInvoiceDetails($invoice_id);
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('sales/invoice',$data);
    }

    public function getInvoiceDetails()
    {
        $ret_products_arr = explode("\r\n",$_POST['ret_products']);
        $invoice_details = $this->sales_model->getInvoiceDetails($_POST['invoice_id']);
        
        $products_str = '';
        foreach($invoice_details['products'] as $key=>$data)
        {
            if(in_array($data->imei_number,$ret_products_arr))
            {
                unset($invoice_details['products'][$key]);
                continue;
            }
            $products_str .= $data->imei_number."\r\n";
        }

        //echo $products_str;die;
        //$pdata = new stdClass();
        $sdata['products'] = $pdata['products'] = $products_str;
        $sdata['invoice_details'] = $invoice_details;
        //print_r($sdata);die;
        $sdata['details'] = $this->stock_model->getStockDetails($pdata);
        $sdata['customers'] = $this->customers_model->getCustomers();
        echo $html = $this->load->view('sales/sale_details',$sdata,true);
    }
}