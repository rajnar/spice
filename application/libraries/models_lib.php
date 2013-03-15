<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Models_lib {
    private $id;
    private $name;
    private $model_number;
    private $price;
    private $categories_id;
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getModel_number() {
        return $this->model_number;
    }

    public function setModel_number($model_number) {
        $this->model_number = $model_number;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getCategories_id() {
        return $this->categories_id;
    }

    public function setCategories_id($categories_id) {
        $this->categories_id = $categories_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}
?>
