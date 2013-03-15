<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Customers_lib {
    private $id;
    private $first_name;
    private $last_name;
    private $address;
    private $city;
    private $state;
    private $zip;
    private $phone_number1;
    private $phone_number2;
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirst_name() {
        return $this->first_name;
    }

    public function setFirst_name($first_name) {
        $this->first_name = $first_name;
    }

    public function getLast_name() {
        return $this->last_name;
    }

    public function setLast_name($last_name) {
        $this->last_name = $last_name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getZip() {
        return $this->zip;
    }

    public function setZip($zip) {
        $this->zip = $zip;
    }

    public function getPhone_number1() {
        return $this->phone_number1;
    }

    public function setPhone_number1($phone_number1) {
        $this->phone_number1 = $phone_number1;
    }

    public function getPhone_number2() {
        return $this->phone_number2;
    }

    public function setPhone_number2($phone_number2) {
        $this->phone_number2 = $phone_number2;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}
?>
