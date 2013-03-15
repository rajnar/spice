<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Sales_payment_details_lib {
    private $id;
    private $receipt_number;
    private $sales_id;
    private $amount;
    private $date_added;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getReceipt_number() {
        return $this->receipt_number;
    }

    public function setReceipt_number($receipt_number) {
        $this->receipt_number = $receipt_number;
    }

    public function getSales_id() {
        return $this->sales_id;
    }

    public function setSales_id($sales_id) {
        $this->sales_id = $sales_id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getDate_added() {
        return $this->date_added;
    }

    public function setDate_added($date_added) {
        $this->date_added = $date_added;
    }
}
?>
