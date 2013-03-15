<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Stock_model extends MY_Model{
    public function __construct() {
        parent::__construct();
    }

    function display_grid($postvals,$sql,$array_fields) {
        return $this->jqgrid($postvals,$sql,$array_fields);
    }

    function saveStock() {
        //echo $this->saveRecord(conversion($_POST,'products_lib'),'products');
        //$products = explode("\r\n",$_POST['imei_number']);
        $products = preg_split('/\n|\r\n?/', trim($_POST['imei_number']));
        $products = array_unique($products);
        $products_str = implode($products,'","');

        $check_products_sql = 'SELECT * FROM products where imei_number in ("'.$products_str.'")';
        $old_products = $this->getDBResult($check_products_sql);
        if(empty($old_products))
        {
            $sql = 'INSERT INTO products ( models_id,imei_number ) values ';
            foreach($products as $imei_no)
            {
                if(rtrim($imei_no) != '')
                {
                    $sql .= '('.$_POST['models_id'].',"'.trim($imei_no).'"),';
                }
            }
            //echo $sql;die;
            $this->db->query(rtrim($sql,','));
			return array('error_code'=>200,'error_msg'=>'success');
        }
        else
        {
            foreach($old_products as $oldproducts)
            {
                //$models[$oldproducts->imei_number] = $oldproducts->models_id;
                $imei_numbers[$oldproducts->models_id][] = $oldproducts->imei_number;
            }

            $models = $this->models_model->getModelsAssoc();
            $error_msg = '';
            foreach($imei_numbers as $modelid=>$imei)
            {
                $duplicate_imei_str = implode($imei,',');
                if($error_msg != '')
                {
                    $error_msg .= ' and ';
                }
                $error_msg .= 'IEMI Number: '.$duplicate_imei_str.' already exist in Model: '.$models[$modelid];
            }
            return array('error_code'=>301,'error_msg'=>$error_msg);
        }
    }

    function getStockDetails_sql($post){
        //$products_arr = explode("\r\n",trim($post['products']));
        $products_arr = preg_split('/\n|\r\n?/', trim($post['products']));
        //print_r($products_arr);die;
        $products_str = implode($products_arr,'","');
        $sql = 'SELECT m.id, m.name, m.model_number, m.price, p.imei_number
                FROM models m
                LEFT JOIN products p ON m.id = p.models_id
                WHERE m.`status` = "a" AND p.imei_number IN ("'.$products_str.'");';
        return $this->getDBResult($sql,'object');
    }

    function getStockOVDetails_sql($post){
        $products_arr = preg_split('/\n|\r\n?/', trim($post['products']));
        //print_r($lines);die;
        //$products_arr = explode("\r\n",trim(trim($post['products'])));
        //echo 'adsf';print_r($products_arr);die;
        $products_str = implode($products_arr,'","');
        $sql = 'SELECT m.id, m.name, m.model_number, sum(m.price) as totalprice, COUNT(p.imei_number) AS total_pieces
                FROM models m
                LEFT JOIN products p ON m.id = p.models_id
                WHERE m.`status` = "a" AND p.imei_number IN ("'.$products_str.'")
                GROUP BY m.id
                ';
        return $this->getDBResult($sql,'object');
    }

    function getStockDetails($post)
    {
        $data['products'] = $this->getStockDetails_sql($post);
        $overview = $this->getStockOVDetails_sql($post);
        $data['overview'] = array();
        $totalSum = 0;
        $totalModels = 0;
        if(!empty($overview))
        {
            foreach($overview as $models)
            {
                $totalSum += $models->totalprice;
                $totalModels++;
            }
            $data['overview'] = $overview;
        }
        $data['overall_details'] = array('total_sum'=>$totalSum,'total_models'=>$totalModels);
        return $data;
    }

    function returnStockSave($post)
    {
        //$products_arr = explode("\r\n",trim(trim($post['products'])));
        $products_arr = preg_split('/\n|\r\n?/', trim($post['products']));
        $products_str = implode($products_arr,'","');
        $sql = 'UPDATE products SET STATUS = "r"
                WHERE imei_number IN ("'.$products_str.'")';
        $rs = $this->db->query($sql);
    }


}

?>
