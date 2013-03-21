<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Reports_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    function display_grid($postvals,$sql,$array_fields){
        return $this->jqgrid($postvals,$sql,$array_fields);
    }

    function getCustomresInvData($from_grid=true)
	{
		$customer_id = $_REQUEST['customer_id'];	
		 $sql = 'select s.id,s.invoice_number,concat(c.first_name," ",c.last_name) as customer_name,
				concat(c.address,"\r\n",c.city,"\r\n",c.state,"\r\n",c.zip) as address,
				concat(c.phone_number1,"\r\n",c.phone_number2) as contact_number,
				s.total_sale_amount,s.discount,s.amount_after_discount,
				sum(spd.amount) as total_paid,
				(s.amount_after_discount- SUM(spd.amount)) AS balance,
				DATE_FORMAT(s.date_added,"%d/%m/%Y") as date_added
				from sales s
				left join sales_payment_details spd on s.id =  spd.sales_id
				left join customers c on c.id = s.customers_id
				where s.customers_id='.$customer_id.' group by spd.sales_id';
			if($from_grid)
			{
				$data_flds = array("<a href='".base_url()."users/addCustomer/{%id%}' id='{%id%}'>{%invoice_number%}</a>",'customer_name','address','contact_number','total_sale_amount','discount','amount_after_discount','total_paid','balance','date_added');
				echo $this->display_grid($_POST,$sql,$data_flds);
			}
			else
			{
				$data = $this->getDBResult($sql,'object');
				$customer = array();
				if(!empty($data))
				{
					foreach($data as $key=>$values) {
						$customer[] = array($values->invoice_number,$values->customer_name,$values->address,$values->contact_number,$values->total_sale_amount,$values->discount,$values->amount_after_discount,$values->total_paid,$values->balance,$values->date_added);
					}	
				}
				return $customer;
			}
	}

    public function getCustomers() {
        $sql = 'SELECT id,CONCAT(first_name," ",last_name) AS customer_name
                FROM customers order by customer_name';
        $data = $this->getDBResult($sql,'object');
        $customer = array();
        foreach($data as $payment_details) {
            $customer[$payment_details->id] = $payment_details->customer_name;
        }
        return $customer;
    }
}

?>
