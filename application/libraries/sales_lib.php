<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Sales_lib {
    private $id;
    private $invoice_number;
    private $customers_id;
    private $total_sale_amount;
    private $payment_method;
    private $other_details;
    private $discount;
    private $amount_after_discount;
    private $date_added;
    private $date_modified;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getInvoice_number() {
        return $this->invoice_number;
    }

    public function setInvoice_number($invoice_number) {
        $this->invoice_number = $invoice_number;
    }

    public function getAmount_after_discount() {
        return $this->amount_after_discount;
    }

    public function setAmount_after_discount($amount_after_discount) {
        $this->amount_after_discount = $amount_after_discount;
    }

    public function getCustomers_id() {
        return $this->customers_id;
    }

    public function setCustomers_id($customers_id) {
        $this->customers_id = $customers_id;
    }

    public function getTotal_sale_amount() {
        return $this->total_sale_amount;
    }

    public function setTotal_sale_amount($total_sale_amount) {
        $this->total_sale_amount = $total_sale_amount;
    }

    public function getPayment_method() {
        return $this->payment_method;
    }

    public function setPayment_method($payment_method) {
        $this->payment_method = $payment_method;
    }

    public function getOther_details() {
        return $this->other_details;
    }

    public function setOther_details($other_details) {
        $this->other_details = $other_details;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    public function getDate_added() {
        return $this->date_added;
    }

    public function setDate_added($date_added) {
        $this->date_added = $date_added;
    }

    public function getDate_modified() {
        return $this->date_modified;
    }

    public function setDate_modified($date_modified) {
        $this->date_modified = $date_modified;
    }

}
?>
