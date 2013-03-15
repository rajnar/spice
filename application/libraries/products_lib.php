<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Products_lib {
    private $id;
    private $models_id;
    private $imei_number;
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getModels_id() {
        return $this->models_id;
    }

    public function setModels_id($models_id) {
        $this->models_id = $models_id;
    }

    public function getImei_number() {
        return $this->imei_number;
    }

    public function setImei_number($imei_number) {
        $this->imei_number = $imei_number;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}
?>
