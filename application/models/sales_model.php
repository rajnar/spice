<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Sales_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    function display_grid($postvals,$sql,$array_fields) {
        return $this->jqgrid($postvals,$sql,$array_fields);
    }

    function saveSale() {
        //print_r($_POST);die;
        $max_sql = 'select max(id)+1 as maxid from sales';
        $rs = $this->getDBResult($max_sql,'object');
        if(isset($_POST['invoice']))
        {
            $sales_id = $invoice_number = $_POST['invoice'];
            $ret_products = explode("\r\n",trim($_POST['ret_products'],"\n"));
            array_walk($ret_products, 'mytrim');
            $ret_products_str = implode($ret_products,'","');
            $update_retsales_sql = 'UPDATE products p SET p.`status` = "c" WHERE p.imei_number IN ("'.$ret_products_str.'")';
            $this->db->query($update_retsales_sql);
            $del_sql = 'delete from sales_products where sales_id='.$invoice_number;
            $this->db->query($del_sql);

            $pay_remove_sql = 'delete from sales_payment_details where sales_id='.$invoice_number;
            $this->db->query($pay_remove_sql);
            $this->saveRecord(conversion($_POST,'sales_lib'),'sales');
        }
        else
        {
            $invoice_number = 1;
            if(!is_null($rs[0]->maxid)) {
                $invoice_number = $rs[0]->maxid;
            }
            $_POST['invoice_number'] = $invoice_number;
            $sales_id = $this->saveRecord(conversion($_POST,'sales_lib'),'sales');
        }

        $data = array('sales_id'=>$sales_id,'amount'=>$_POST['amount']);
        $receipt_sql = 'select max(id)+1 as maxid from sales_payment_details';
        $receipt_rs = $this->getDBResult($receipt_sql,'object');
        $data['receipt_number'] = 1;
        if(!is_null($receipt_rs[0]->maxid)) {
            $data['receipt_number'] = $receipt_rs[0]->maxid;
        }
        $payment_id = $this->saveRecord(conversion($data,'sales_payment_details_lib'),'sales_payment_details');

        $products = explode("\r\n",trim($_POST['products'],"\n"));
        array_walk($products, 'mytrim');
        $products_str = implode($products,'","');
        $update_sales_sql = 'UPDATE products p SET p.`status` = "s" WHERE p.imei_number IN ("'.$products_str.'")';
        $this->db->query($update_sales_sql);

        $sale_products = $this->stock_model->getStockDetails($_POST);
        $sql = 'INSERT INTO sales_products ( sales_id,products_id ) values ';
        foreach($sale_products['products'] as $prod_id) {
            if($prod_id != '') {
                $sql .= '('.$sales_id.',"'.$prod_id->imei_number.'"),';
            }
        }
        $this->db->query(rtrim($sql,','));
        return $sales_id;
    }

    public function getTotalPayment_Details() {
        $sql = 'SELECT sales_id, SUM(amount) AS total_payment
                FROM sales_payment_details spd
                GROUP BY spd.sales_id';
        $data = $this->getDBResult($sql,'object');
        $payments = array();
        foreach($data as $payment_details) {
            $payments[$payment_details->sales_id] = $payment_details->total_payment;
        }
        return $payments;
    }
    public function getInvoiceDetails($invoice_id) {
        $details_sql = 'SELECT s.*,CONCAT(c.first_name," ",c.last_name) AS customer_name, SUM(spd.amount) AS amount_paid,
                        (s.amount_after_discount- SUM(spd.amount)) AS balance_amount,
                        c.address, c.city, c.state, c.zip, c.phone_number1, c.phone_number2
                        FROM sales s
                        INNER JOIN sales_payment_details spd ON s.id = spd.sales_id
                        INNER JOIN customers c ON c.id = s.customers_id
                        WHERE s.id='.$invoice_id.'
                        GROUP BY s.id';
        $details_qry = $this->db->query($details_sql);
        $data['details_rs'] = $details_qry->first_row();
        $data['products'] = $this->getInvoiceProducts($invoice_id);
        return $data;
    }

    public function getInvoiceProducts($invoice_id){
        $sql = 'SELECT m.model_number, m.name, m.price, p.imei_number
                FROM sales_products sp
                INNER JOIN products p ON p.imei_number = sp.products_id
                INNER JOIN models m ON p.models_id = m.id
                WHERE sp.sales_id = '.$invoice_id.'
                GROUP BY sp.products_id';
        $qry = $this->db->query($sql);
        $rs = $qry->result();
        return $rs;
    }

    public function saveAmount($data)
    {
        $receipt_sql = 'select max(id)+1 as maxid from sales_payment_details';
        $receipt_rs = $this->getDBResult($receipt_sql,'object');
        $data['receipt_number'] = 1;
        if(!is_null($receipt_rs[0]->maxid)) {
            $data['receipt_number'] = $receipt_rs[0]->maxid;
        }
        $payment_id = $this->saveRecord(conversion($data,'sales_payment_details_lib'),'sales_payment_details');
        $pay_details = $this->getPayDetails($data['sales_id']);
        $pay_details[0]->receipt_number = $data['receipt_number'];
        return $pay_details[0];
    }

    public function getPayDetails($invoice_id)
    {
        $sql = 'SELECT CONCAT(c.first_name," ",c.last_name) AS name,c.phone_number1, c.phone_number2,
                s.invoice_number, s.total_sale_amount, s.discount, s.amount_after_discount, s.other_details, s.date_added, SUM(spd.amount) AS amount_paid, (s.amount_after_discount- SUM(spd.amount)) AS balance_amount
                FROM sales s
                INNER JOIN customers c ON c.id = s.customers_id
                INNER JOIN sales_payment_details spd ON spd.sales_id = s.invoice_number
                WHERE s.invoice_number = '.$invoice_id.'
                GROUP BY invoice_number';
        $rs = $this->getDBResult($sql,'object');
        return $rs;
    }
}

?>
