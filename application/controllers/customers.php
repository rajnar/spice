<?php if (!defined('BASEPATH')) die();
class Customers extends Main_Controller {
    public function index() {
        $header_data['active_tab'] = 'customers';
		$header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('customers/index',$data);
    }

    public function getCustomers()
    {
        $sql = 'SELECT id,CONCAT(first_name," ",last_name) AS name,address,city,state,zip,phone_number1,phone_number2,`status`
                FROM customers';
        $data_flds = array('name','address','city','state','zip','phone_number1','phone_number2',"<a href='".base_url()."customers/customer/{%id%}' id='{%id%}'>Edit</a>");
	echo $this->customers_model->display_grid($_POST,$sql,$data_flds);
    }

    public function customer($id = 0)
    {
        if($id)
        {
            $cus_data = $this->customers_model->getCustomerDetails($id);
        }
        else
        {
            $cus_data = tableEmptyValues('customers');
        }
        
        $data['cus_data'] = $cus_data;
        $header_data['active_tab'] = 'customers';
		$header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('customers/customer',$data);
    }

    public function saveCustomer()
    {
       $this->customers_model->saveCustomer();
    }

    public function libhelp()
    {
        //$tbl_array = array('categories','customers','models','products','sales','sales_products');
        $tbl_array = array('sales_payment_details');
        $data = $this->customers_model->gettabledetails($tbl_array);
        /*echo '<pre>';
        print_r($data);*/
        foreach($data as $key=>$val)
        {
            echo 'private $'.$key.';<br>';
        }
    }

    public function updateTriggerHelp()
    {
        $rs = $this->db->query('show tables');
        echo '<pre>';
        foreach($rs->result() as $tables)
        {
            //echo $tables->Tables_in_edealspot.'<br>';
            echo $this->users_model->myTriggers($tables->Tables_in_edealspot_oct_11).'<br><br><br><br>';
        }
        //die;

        //echo $qry;
    }

    public function insertTriggerHelp()
    {
        $rs = $this->db->query('show tables');
        /*echo '<pre>';
        print_r($rs->result());die;*/
        foreach($rs->result() as $tables)
        {
            //echo $tables->Tables_in_edealspot.'<br>';
            echo $this->users_model->myTriggersInsert($tables->Tables_in_edealspot_oct_11).'<br><br><br><br>';
        }
        //die;

        //echo $qry;
    }

    public function deleteTriggerHelp()
    {
        $rs = $this->db->query('show tables');
        echo '<pre>';
        foreach($rs->result() as $tables)
        {
            //echo $tables->Tables_in_edealspot.'<br>';
            echo $this->users_model->myTriggersDelete($tables->Tables_in_edealspot_oct_11).'<br><br><br><br>';
        }
        //die;

        //echo $qry;
    }
}