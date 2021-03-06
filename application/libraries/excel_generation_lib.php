<?php
class Excel_generation_lib {

    public function excel_generation($data) {
        $headers = $data['headers'];
        $values = $data['values'];
        $date_range = $data['date_range'];

        include(APPPATH.'third_party/PHPExcel.php');
        include(APPPATH.'third_party/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator('');
        $objPHPExcel->getProperties()->setLastModifiedBy('');
        $objPHPExcel->getProperties()->setTitle('');
        $objPHPExcel->getProperties()->setSubject('');
        $sub_title = '';
        if($date_range['fromdate']!='' && $date_range['todate']!='') {
            $sub_title = "Invoice Details between ".$date_range['fromdate']." and ".$date_range['todate'];
        }

        $tilte_heading = 'Invoice';
        $row=1;

        $rep_gen_by = 'Report Generated on '.date('m/d/y h:i A');

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $rep_gen_by);
        if($sub_title !='') {
            $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(2,$row,4,$row);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $sub_title);
            $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray(
                array(
                'font' => array(
                'name'         => 'Arial',
                'bold'         => false,
                'italic'    => false,
                'size'        => 10,
                'color'     => array(
                'rgb' => '000000'
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
        }
        $row++;
        $heading = 'SIREE MOBILES';
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,$row,9,$row);
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
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('G'.$row, $val['total_amt'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('H'.$row, $val['total_paid'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('I'.$row, $val['balance'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, $val['date_added']);
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

                $range = 'D'.$row.':'.'J'.$row;
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
        $filename = 'invoice.xlsx';
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
	public function stock_generation($data) {
        $headers = $data['headers'];
        $values = $data['values'];

        include(APPPATH.'third_party/PHPExcel.php');
        include(APPPATH.'third_party/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator('');
        $objPHPExcel->getProperties()->setLastModifiedBy('');
        $objPHPExcel->getProperties()->setTitle('');
        $objPHPExcel->getProperties()->setSubject('');
        $sub_title = '';
        
		$tilte_heading = 'Stock Details';
        $row=1;

        $rep_gen_by = 'Report Generated on '.date('m/d/y h:i A');

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $rep_gen_by);
        if($sub_title !='') {
            $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(2,$row,4,$row);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $sub_title);
            $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray(
                array(
                'font' => array(
                'name'         => 'Arial',
                'bold'         => false,
                'italic'    => false,
                'size'        => 10,
                'color'     => array(
                'rgb' => '000000'
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
        }
        $row++;
        $heading = 'SIREE MOBILES';
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,$row,3,$row);
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $heading);
        $range = 'A'.$row.':'.'D'.$row;
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
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $val['model_number']);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $val['name']);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$row, $val['price'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$row, $val['total_pieces'],PHPExcel_Cell_DataType::TYPE_STRING);
                //}

                $range = 'A'.$row.':'.'B'.$row;
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

                $range = 'C'.$row.':'.'D'.$row;
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
        $filename = 'stock_details.xlsx';
        $url = 'downloads/'.$filename;
        $objWriter->save($url);
        return $filename;
    }

}
?>