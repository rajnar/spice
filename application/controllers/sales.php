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
                TRUNCATE((s.amount_after_discount- SUM(spd.amount)),2) AS balance
                FROM sales s
                INNER JOIN customers c ON c.id = s.customers_id
                RIGHT JOIN sales_payment_details spd ON spd.sales_id = s.id
                GROUP BY sales_id';
        $data_flds = array('invoice_number','name','total_sale_amount','discount','amount_after_discount','total_paid','balance','payment_method','date_added',"<a href='".base_url()."sales/payAmount/{%id%}' id='{%id%}' class='btn-small'>Bill Payment</a>");
        echo $this->sales_model->display_grid($_POST,$sql,$data_flds);
    }

    public function payAmount($invoice_id)
    {
        $header_data['active_tab'] = 'sales';
        $header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $data['invoice_id'] = $invoice_id;
        $this->load->view('sales/payamount',$data);
    }

    public function saveAmount()
    {
        $data['pay_details'] = $this->sales_model->saveAmount($_POST);
        echo $this->load->view('sales/receipt_details',$data);
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
	public function invoice_excel($invoice_id=14) {
        $data = $this->sales_model->getInvoiceDetails($invoice_id);
		//echo '<pre>'; print_r($data);die;
		
		include(APPPATH.'third_party/PHPExcel.php');
		include(APPPATH.'third_party/PHPExcel/Writer/Excel2007.php');
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator('');
        $objPHPExcel->getProperties()->setLastModifiedBy('');
        $objPHPExcel->getProperties()->setTitle('');
        $objPHPExcel->getProperties()->setSubject('');

        $user = 'Narendra';
		$tilte_heading = 'Invoice';
        $row=1;

        $rep_gen_by = 'Invoice Generated  on '.date('m/d/y h:i A');

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $rep_gen_by);
		$row++;
		$column = 'A';
		//echo '<pre>';
		//print_r($headers);
		//print_r($values);
		//die;
        if(!empty($data)) {
         $first_row = $row; 
		 $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('25');
		 $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('25');
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Invoice');
		 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $data['details_rs']->invoice_number);
		 $row++;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Invoice Date');
		 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $data['details_rs']->date_added);
		 $row++;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Customer Name');
		 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $data['details_rs']->customer_name);
		 $row++;
		 $address = $data['details_rs']->address."\n".$data['details_rs']->city."\n".$data['details_rs']->state."\n".$data['details_rs']->zip;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Address');
		 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $address);
		 $row++;
		 $contact_numbers =  $data['details_rs']->phone_number1.",\n". $data['details_rs']->phone_number2;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Contact Numbers');
 		 $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$row, $contact_numbers,PHPExcel_Cell_DataType::TYPE_STRING);
		 $row++;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Total Sale Amount (Rs)');
		 $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$row, $data['details_rs']->total_sale_amount,PHPExcel_Cell_DataType::TYPE_STRING);		 
		 $row++;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Discount (Rs)');
		 $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$row, $data['details_rs']->discount,PHPExcel_Cell_DataType::TYPE_STRING);
		 $row++;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Payable Amount (Rs)');
 		 $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$row, $data['details_rs']->amount_after_discount,PHPExcel_Cell_DataType::TYPE_STRING);
		 $row++;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Paid Amount (Rs)');
		 $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$row, $data['details_rs']->amount_paid,PHPExcel_Cell_DataType::TYPE_STRING);
 		 $row++;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Balance Amount (Rs)');
		 $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$row, $data['details_rs']->balance_amount,PHPExcel_Cell_DataType::TYPE_STRING);
		 $row++;
		 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Products Sold (IMEI Numbers)');
			$products = $data['products'];
			$tot_imei = count($products);
			
			for($i=0;$i<$tot_imei;$i++)
			{
				 $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$row, $products[$i]->imei_number,PHPExcel_Cell_DataType::TYPE_STRING);
				 $row++;					 
			}
				
		
		$range = 'A'.$first_row.':'.'B'.$row;
		$objPHPExcel->getActiveSheet()->duplicateStyleArray(
                    array(
                    'font' => array(
                    'name'         => 'Arial',
                    'bold'         => false,
                    'italic'    => false,
                    'size'        => 9
                    ),
                    'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                    ),
                    'borders' =>array(
                    'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                    )
                    ),
                    //$go_first_clmn.$row.':'.$go_last_clmn.$row
                    $range
                );

		 }		
		//die;
		 $objPHPExcel->setActiveSheetIndex(0);
        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('aa');

        // Save Excel 2003 file
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $filename = 'invoice_'.$invoice_id.'.xls';
        $url = 'downloads/'.$filename;
		//$url = $filename;
        //$res = $objWriter->save($url);
        //$this->download($filename);
        if($objWriter->save($url) == '') {
            echo json_encode(array('status_code'=>200,'status_message'=>'success','filename'=>''));
        }
        else {
            echo json_encode(array('status_code'=>201,'status_message'=>'Unable to generate Excel'));
        }
	
		
		
		
    }
}