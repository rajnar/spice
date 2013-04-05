<?php
class Excel_generation_lib {
    
	public function excel_generation($data)
	{
        $headers = $data['headers'];
		$values = $data['values'];
		
		include(APPPATH.'third_party/PHPExcel.php');
		include(APPPATH.'third_party/PHPExcel/Writer/Excel2007.php');
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator('');
        $objPHPExcel->getProperties()->setLastModifiedBy('');
        $objPHPExcel->getProperties()->setTitle('');
        $objPHPExcel->getProperties()->setSubject('');

		$tilte_heading = 'Invoice';
        $row=1;

        $rep_gen_by = 'Report Generated on '.date('m/d/y h:i A');

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $rep_gen_by);
		$row++;
		$heading = 'SIREE MOBILES';
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,$row,10,$row);
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $heading);
        $range = 'A'.$row.':'.'I'.$row;
        $objPHPExcel->getActiveSheet()->getStyle($range)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('1969a6');
		 $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray(
            array(
            'font' => array(
            'name'         => 'Arial',
            'bold'         => false,
            'italic'    => false,
            'size'        => 12,
            'color'     => array(
            'rgb' => 'FFFFFF'
            )
            ),
            'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap'       => true
            ),
            'borders' =>array(
            'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
            )
            )
            )
        );
		$row++;
		$column = 'A';
		//echo '<pre>';
		//print_r($headers);
		//print_r($values);
		//die;
        if(!empty($headers)) {
           
            foreach($headers as $k=>$v) {
               //echo $v;
			   $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setWidth('25');
			    $objPHPExcel->getActiveSheet()->SetCellValue($column.$row, $v);
                $end_column = $column;
                $column++;
            }
       
		$range = 'A'.$row.':'.$end_column.$row;
		$objPHPExcel->getActiveSheet()->duplicateStyleArray(
                    array(
                    'font' => array(
                    'name'         => 'Arial',
                    'bold'         => false,
                    'italic'    => false,
                    'size'        => 9
                    ),
                    'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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
		$row++;
		$first_row = $row;
        if(!empty($values)) {
            foreach($values as $key=>$val) {
				$column = 'A';
				//foreach($val as $k=>$v) {
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $val['invoice_number']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $val['customer_name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $val['address']);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$row, $val['total_sale_amount'],PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$row, $val['discount'],PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$row, $val['amount_after_discount'],PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('G'.$row, $val['vat_amount'],PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('H'.$row, $val['amount_with_vat'],PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('I'.$row, $val['total_paid'],PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('J'.$row, $val['balance'],PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, $val['date_added']);
				//}
				
				$range = 'A'.$row.':'.'C'.$row;
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
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP,
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
				
				$range = 'D'.$row.':'.'K'.$row;
				$objPHPExcel->getActiveSheet()->duplicateStyleArray(
                    array(
                    'font' => array(
                    'name'         => 'Arial',
                    'bold'         => false,
                    'italic'    => false,
                    'size'        => 9
                    ),
                    'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
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
				
				$row++;
            }
			
		
        }
		//die;
		 $objPHPExcel->setActiveSheetIndex(0);
        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('aa');

        // Save Excel 2003 file
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $filename = 'invoice.xls';
        $url = 'downloads/'.$filename;
		$objWriter->save($url);
		return $filename;
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
?>
