<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Sales_products_lib {
    private $id;
    private $sales_id;
    private $products_id;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getSales_id() {
        return $this->sales_id;
    }

    public function setSales_id($sales_id) {
        $this->sales_id = $sales_id;
    }

    public function getProducts_id() {
        return $this->products_id;
    }

    public function setProducts_id($products_id) {
        $this->products_id = $products_id;
    }

}
?>
