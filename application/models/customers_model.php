<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Customers_model extends MY_Model{
    public function __construct() {
        parent::__construct();
    }
    
    function display_grid($postvals,$sql,$array_fields) {
        return $this->jqgrid($postvals,$sql,$array_fields);
    }

    function saveCustomer() {
        /*echo '<pre>';
        print_r($_POST);die;*/
        echo $this->saveRecord(conversion($_POST,'customers_lib'),'customers');
    }

    function getCustomers(){
        $sql = 'SELECT * FROM customers ORDER BY first_name';
        $customers = $this->getDBResult($sql, 'object');
        /*foreach($customers_rs as $cus_details)
        {
            $customers[$cus_details->id] = $cus_details;
        }*/
        return $customers;
    }

    function getCustomerDetails($id)
    {
        $cus_sql = 'SELECT * FROM customers c WHERE c.id = '.$id;
        $rs = $this->db->query($cus_sql);
        $data = $rs->result();
        return $data[0];
    }

    function gettabledetails($tablenames=array())
    {
        $tbl_fields = new stdclass();
        foreach($tablenames as $tablename)
        {
            $sql = "show columns from `".$tablename."`";
            $fields = $this->getDBResult($sql, 'object');
            foreach($fields as $values)
            {
                $fld = $values->Field;
                $tbl_fields->$fld = '';
            }
        }
        return $tbl_fields;
    }
}

?>
